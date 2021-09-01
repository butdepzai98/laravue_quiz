import Vue from 'vue'
import VueRouter from 'vue-router'
import Home from '../views/Home.vue'

Vue.use(VueRouter)

const routes = [
  {
    path: '/',
    name: 'Home',
    component: Home
  },
  {
    path: '/register',
    name: 'Register',
    component: () => import(/* webpackChunkName: "Register" */ '../components/Register.vue')
  },
  {
    path: '/exam',
    name: 'Exam',
    component: () => import(/* webpackChunkName: "Exam" */ '../components/Exam/List.vue')
  },
  {
    path: '/exam/form',
    name: 'ExamForm',
    component: () => import(/* webpackChunkName: "ExamForm" */ '../components/Exam/Form.vue')
  },
  {
    path: '/question',
    name: 'Question',
    component: () => import(/* webpackChunkName: "Question" */ '../components/Question/List.vue')
  },
  {
    path: '/question/form',
    name: 'QuestionForm',
    component: () => import(/* webpackChunkName: "QuestionForm" */ '../components/Question/Form.vue')
  },
  {
    path: '/result',
    name: 'Result',
    component: () => import(/* webpackChunkName: "Result" */ '../components/Result/List.vue')
  },
  {
    path: '/result/form',
    name: 'ResultForm',
    component: () => import(/* webpackChunkName: "ResultForm" */ '../components/Result/Form.vue')
  },
  {
    path: '/user',
    name: 'User',
    component: () => import(/* webpackChunkName: "User" */ '../components/User/List.vue')
  },
  {
    path: '/user/form',
    name: 'UserForm',
    component: () => import(/* webpackChunkName: "UserForm" */ '../components/User/Form.vue')
  }
]

const router = new VueRouter({
  mode: 'history',
  base: process.env.BASE_URL,
  routes
})

export default router
