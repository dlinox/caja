import { defineConfig } from "vite";
import vue from "@vitejs/plugin-vue";
export default defineConfig(({ mode }) => ({
  // base: mode === "production" ? "/caja/pago_admision/dist" : "/",
  base: mode === "production" ? "/pago_admision/dist" : "/",
  
  plugins: [vue()],
  resolve: {
    alias: {
      "@": "/src",
    },
  },
}));
