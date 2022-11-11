import { fileURLToPath, URL } from 'node:url'

import { defineConfig } from 'vite'
import vue from '@vitejs/plugin-vue'
import { VitePWA } from 'vite-plugin-pwa'

// https://vitejs.dev/config/
export default defineConfig({
  plugins: [vue(),
     VitePWA({
      registerType: 'autoUpdate',
      additionalManifestEntries: [
        {url: '/offline', revision: null},
        {url: 'https://static.express/img/.../connection-lost.svg', revision: null},
      ],
      devOptions: {
        enabled: true
      },
      workbox: {
        cleanupOutdatedCaches: false
      },
      includeAssets: ['favicon.ico', 'logo.png', 'masked-icon.svg'],
      manifest: {
        id: 'sm',
        name: 'Smart Manager',
        short_name: 'Smart Manager',
        description: 'Smart Manager makaes your life easier',
        theme_color: '#ffffff',
        icons: [
          {
            src: 'logo.png',
            sizes: '192x192',
            type: 'image/png'
          },
          {
            src: 'logo.png',
            sizes: '512x512',
            type: 'image/png'
          }
        ]
      }
    })
  ],
  resolve: {
    alias: {
      '@': fileURLToPath(new URL('./src', import.meta.url))
    }
  }
})
