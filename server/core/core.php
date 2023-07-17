<?php
defined('BASEPATH') or exit('No direct script access allowed');

class CORE
{
    protected $response;


    public function __construct()
    {
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Methods: GET,POST");
        header("Access-Control-Allow-Headers: Content-Type");

        $this->response = [];
    }

    public function getCurrentUser()
    {
        session_start();

        if (!isset($_SESSION['idusuario'])) {
            $this->response['success'] = false;
            $this->response['message'] = 'No autorizad(a)';
            $this->response['data'] = null;
            echo json_encode($this->response);
            exit;
        } else {
            $this->response['success'] = true;
            $this->response['message'] = 'Biemvenid(a) ...';
            $this->response['data'] = [
                'user' => $_SESSION['idusuario'],
            ];
            echo json_encode($this->response);
            exit;
        }
    }

    public function getDataAdmition()
    {
        $headers = array(
            'Content-Type: application/json',
            'Authorization: Bearer 8|eQ5sFCCQzTpCKP9nXS9rYpzeaku0tF7ib2iNbglb'
        );

        $url = 'https://inscripciones.admision.unap.edu.pe/api/get-postulante-pago/71576906/4';

        $options = array(
            'http' => array(
                'header' => implode("\r\n", $headers)
            )
        );
        $context = stream_context_create($options);
        $response = file_get_contents($url, false, $context);
        $data = json_decode($response);

        $this->response['success'] = $data->status;
        $this->response['message'] = $data->mensaje;
        $this->response['data'] = $data->data;
        echo json_encode($this->response);
    }

    public function savePago($person, $details)
    {
        // if (!isset($_SESSION['idusuario'])) {
        //     $this->response['success'] = false;
        //     $this->response['message'] = 'No autorizad(a)';
        //     $this->response['data'] = null;
        //     echo json_encode($this->response);
        //     exit;
        // }
        include 'cn.php';

        $cn->begin_transaction();
        try {

            $pagoPapeleta = $this->savePapeletaPago($person, $cn);

            foreach ($details as $value) {
                $this->saveDetaPapeletaPago($pagoPapeleta->idpadre, $value, $cn);
            }

            $this->response['success'] = true;
            $this->response['message'] = 'Pago regitrado con exito';
            $this->response['data'] = $pagoPapeleta;

            $cn->commit();
            $cn->close();

            echo json_encode($this->response);
        } catch (\Throwable $th) {
            $this->response['success'] = false;
            $this->response['message'] = $th;
            $this->response['data'] = null;
            $cn->rollback();
            $cn->close();
            echo json_encode($this->response);
        }
    }

    public function savePapeletaPago($person, $cn)
    {

        $var_anio =  '2023'; //$_SESSION['anio']; //*default: 2023
        $idusuario =  '0028'; //$_SESSION['idusuario']; //*default: root

        $fecha     = date('Y-m-d');

        $idtipo    = 4; //*default: otro persona 
        $idcodigo = $person->nro_doc;
        $codigo    = $person->nro_doc;
        $nombre    = $person->nombres . ' ' . $person->primer_apellido  . ' ' .  $person->segundo_apellido;
        $clave = $this->generar_clave();
        $obs    = ""; //*default: sin observaciones

        $ip = $_SERVER['REMOTE_ADDR'];

        $sql  = "select teso_caja.serie from teso_usuariocaja left join teso_caja on teso_caja.idcaja=teso_usuariocaja.idcaja where teso_usuariocaja.idusuario ='$idusuario'";
        $result = $cn->query($sql);
        $row = $result->fetch_array();
        $serie = $row['serie'];

        # Generamos el numero
        $sql = "select max(numero) as maxnum from teso_papeletapago where anio='$var_anio' and serie='$serie'";
        $result = $cn->query($sql);
        $row = $result->fetch_array();
        $numero = str_pad($row['maxnum'] + 1, 6, '0', STR_PAD_LEFT);


        $sql = "insert into teso_papeletapago (anio,serie,numero,fecha,obs,hora,estado,clave,tipo,idcodigo,codigo,idusuario, nombre,ip) ";
        $sql .= "values ('$var_anio','$serie','$numero','$fecha','$obs',CURRENT_TIMESTAMP,'0','$clave','$idtipo','$idcodigo','$codigo','$idusuario', '$nombre','$ip') ";

        $cn->query($sql);

        $sql = "select max(idpapeleta) as maxid from teso_papeletapago";
        $result = $cn->query($sql);
        $row = $result->fetch_array();
        $newid = $row['maxid'];

        $datos = (object) [
            'idpadre' => $newid,
            'serie' => $serie,
            'numero' => $numero,
            'clave' => $clave,
            'error' => $cn->error
        ];

        // $this->saveOtraPersona($person);
        return $datos;
    }


    public function saveDetaPapeletaPago($papeleta, $detail, $cn)
    {

        $idpadre = $papeleta;
        $idtarifa = $detail->value;
        $cantidad = 1; //*Default: 1
        $precio = $detail->price;
        // $detalle = $detail->title;
        $detalle = '';

        $sql = "insert into teso_papeletatarifas (idpapeleta,idtarifa,cantidad,precio,detalle) ";
        $sql .= "values ('$idpadre','$idtarifa','$cantidad','$precio','$detalle') ";
        $cn->query($sql);

        $sql = "select IF(SUM(round(cantidad*precio,2)) IS NULL,0.00,SUM(round(cantidad*precio,2))) total from teso_papeletatarifas where idpapeleta='$idpadre'";
        $result = $cn->query($sql);
        $row = $result->fetch_array();
        $importe = $row['total'];

        $sql = "update teso_papeletapago set ";
        $sql .= "total='$importe' ";
        $sql .= "where idpapeleta='$idpadre'";
        $cn->query($sql);
    }

    public function saveOtraPersona($person)
    {

        include 'cn.php';

        $sql = "select  from teso_otrapersona where idpapeleta='$idpadre'";
        $result = $cn->query($sql);
        $row = $result->fetch_array();
        $importe = $row['total'];

        $postdata = json_decode(file_get_contents("php://input"));

        $codigo        = $postdata->codigo;
        $nombre        = $postdata->nombre;
        $direccion    = $postdata->direccion;
        $email        = $postdata->email;
        $telefono    = $postdata->telefono;

        # Generamos la nueva llave primaria
        $sql = "insert into teso_otrapersona (codigo,nombre,direccion,email,telefono) ";
        $sql .= "values ('$codigo','$nombre','$direccion','$email','$telefono') ";
        $cn->query($sql);
    }



    protected function generar_clave()
    {
        $caracteres = "abcdefghijklmnopqrstuvwxyz1234567890"; //posibles caracteres a usar
        $numerodeletras = 20; //numero de letras para generar el texto
        $cadena = ""; //variable para almacenar la cadena generada
        for ($i = 0; $i < $numerodeletras; $i++) {
            $cadena .= substr($caracteres, rand(0, strlen($caracteres)), 1); /*Extraemos 1 caracter de los caracteres
        entre el rango 0 a Numero de letras que tiene la cadena */
        }
        return $cadena;
    }
}