import Vue from 'vue'
import Router from 'vue-router'
import tabla from '@/components/tabla.vue'

Vue.use(Router)

export default new Router({
  routes: [
    {
      path: '/',
      name: 'tabla',
      component: tabla
    }
  ]
})
