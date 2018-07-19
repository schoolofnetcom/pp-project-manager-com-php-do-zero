import Vue from 'vue'
import Router from 'vue-router'
import Home from '@/components/Home'
import Projects from '@/components/Projects'
import ProjectList from '@/components/projects/List'

Vue.use(Router)

export default new Router({
  routes: [
    {
      path: '/',
      redirect: '/projects'
    },
    {
      path: '/projects',
      component: Projects,
      children: [
        {
          path: '',
          component: ProjectList
        }
      ]
    },
  ]
})
