import Vue from 'vue'
import Router from 'vue-router'
import axios from 'axios';
import VueAxios from 'vue-axios';

// Containers
import Full from '../containers/Full'

// Views
import Dashboard from '../views/Dashboard'
import Charts from '../views/Charts'
import Widgets from '../views/Widgets'


// Views - Components
import Buttons from '../views/components/Buttons'
import SocialButtons from '../views/components/SocialButtons'
import Cards from '../views/components/Cards'
import Forms from '../views/components/Forms'
import Modals from '../views/components/Modals'
import Switches from '../views/components/Switches'
import Tables from '../views/components/Tables'


// Views - Icons
import FontAwesome from '../views/icons/FontAwesome'
import SimpleLineIcons from '../views/icons/SimpleLineIcons'

// Views - Pages
import Page403 from '../views/pages/Page403'
import Page404 from '../views/pages/Page404'
import Page500 from '../views/pages/Page500'
import Login from '../views/pages/Login'
import Register from '../views/pages/Register'


// Admin Entities
import Categories from '../views/categories/Category'
import SubmissionLists from '../views/submissions/SubmissionLists'
import PromoCodes from '../views/promocodes/PromoCode'

// User Management
import Users from '../views/users/Users'
import Roles from '../views/roles/Roles'
import Landing from '../views/pages/Landing'
import Success from '../views/pages/Success'
import Confirmation from '../views/pages/Confirmation'


//House Pages
import Houses from '../views/houses/Houses'
import CreateHouse from '../views/houses/CreateHouse'
import HouseList from '../views/houses/HouseList'
import EditHouse from '../views/houses/EditHouse'
import ShowHouse from '../views/houses/ShowHouse.vue'
import SearchHouse from '../views/houses/SearchHouse.vue'

//Agent Pages
import CreateAgent from '../views/agents/CreateAgent.vue'
import EditAgent from '../views/agents/EditAgent.vue'
import ListAgent from '../views/agents/ListAgent.vue'


Vue.use(Router)
Vue.use(VueAxios, axios)
axios.defaults.baseURL = '/api'



export default new Router({
  mode: 'history', // Demo is living in GitHub.io, so required!
  linkActiveClass: 'open active',
  scrollBehavior: () => ({ y: 0 }),
  routes: [
    {
      path: '/',
      name: 'Landing',
      redirect: '/users',
      component: Full,
      forbiddenRedirect: '/403',
      children: [
        // {
        //   path: 'dashboard',
        //   name: 'Dashboard',
        //   component: Dashboard,
        //   meta: {
        //    auth: true,
        //    forbiddenRedirect: '/admin/403'
        //   }
        // },
        {
          path: 'users',
          name: 'Users',
          component: Users,
          meta: {
            auth: true
          }
        },
        {
          path: 'roles',
          name: 'Roles',
          component: Roles,
          meta: {
            auth: true
          }
        },
  
        // {
        //   path: 'submissions',
        //   name: 'Submissions',
        //   redirect: '/admin/submissions/list',
        //   component: {
        //     render (c) { return c('router-view') }
        //   },
        //   meta: {
        //     auth: true
        //   },
        //   children:
        //     [
        //     {
        //       path: 'list',
        //       name: 'Submission List',
        //       component: SubmissionLists,
        //       meta: {
        //         auth: true
        //       }
        //     },
        //   ]
        // },
        // {
        //   path: 'promocodes',
        //   name: 'Promo Codes',
        //   component: PromoCodes,
        //   meta:{
        //     auth:true
        //   }
        // },
        // {
        //   path: 'categories',
        //   name: 'Categories',
        //   component: Categories,
        //   meta:{
        //     auth:true
        //   }
        // },

      ]
    },
   {
    path: '/login',
    name: 'Login',
    component: Login,
    meta: {
      auth: false
    }
   },
   {
    path : '/houses',
    name : 'Houses',
    component : Houses,
    meta : {
      auth : false
    }
   },
   {
    path : '/houses/list',
    name : 'House List',
    component : HouseList,
    meta : {
      auth : true
    }
  },
  {
    path : '/houses/edit/:id',
    name : 'Edit House',
    component : EditHouse,
    props: true,
    meta : {
      auth : true
    }
  },
  {
    path : '/houses/show/:id',
    name : 'Show House',
    component : ShowHouse,
    props: true,
    meta : {
      auth : false
    }
  },
  
   {
    path : '/houses/create',
    name : 'New House',
    component : CreateHouse,
    meta : {
      auth : true
    }
   },
   {
    path : '/houses/search',
    name : 'Search House',
    component : SearchHouse,
    meta : {
      auth : false
    }
   },
   {
      path : '/agent/create',
      name: 'New Agent',
      component: CreateAgent,
      meta: {
        auth: true
      }
   },
   {
    path : '/agent/edit',
    name: 'Edit Agent',
    component: EditAgent,
    meta: {
      auth: true
    }
 },
 {
  path : '/agent/list',
  name: 'List Agent',
  component: ListAgent,
  meta: {
    auth: true
  }
},
   {
    path: '/registers',
    name: 'Register',
    component: Register,
  },
  {
   path: '/success',
   name: 'Success',
   component: Success,
 },
  {
    path: '/404',
    name: '404',
    component: Page404,
  },
  {
    path: '/403',
    name: '403',
    component: Page403,
  },
  {
    path: '*',
    redirect: '/404',
  },
  ]
})
