import jQuery from 'jquery';
window.$ = jQuery;
import './bootstrap';


import { createApp } from 'vue'
import { createRouter,createWebHistory } from 'vue-router'

import App from './components/App.vue'
import Invoices from './components/Invoices.vue'
import InvoiceDetails from './components/InvoiceDetails.vue'

const routes = [{
    path: '/',
    component: Invoices
  },
  {
    path: '/invoice-details/:invoiceId',
    component: InvoiceDetails
  }
]

const router = createRouter({
  history: createWebHistory(),
  routes
})
export default router

createApp(App).use(router).mount("#app")