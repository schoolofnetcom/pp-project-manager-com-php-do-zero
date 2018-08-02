import Vue from 'vue'
import Router from 'vue-router'
import Home from '@/components/Home'
import Projects from '@/components/Projects'
import ProjectList from '@/components/projects/List'
import ProjectShow from '@/components/projects/Show'
import Schedules from '@/components/Schedules'

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
        },
        {
          path: ':id',
          component: ProjectShow
        }
      ]
    },
    {
      path: '/schedules',
      component: Schedules
    }
  ]
})
