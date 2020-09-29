import MainComponent from './components/MainComponent.vue';
import Dashboard from './components/Dashboard.vue';
import MenuComponent from './components/Config/MenuComponent.vue';
import Login from './components/Login.vue';
import RoleComponent from './components/Config/RoleComponent.vue';
import UserComponent from './components/Admin/UserComponent.vue';
import PermissionComponent from './components/Config/PermissionComponent.vue';

export const routes = [

{
	path:'/',
	component: Login,
	meta: {dataUrl: 'api/settings', pageTitle : 'goMyair'},
},

{
    path: '/dashboard',
    component: Dashboard,
    meta: {
        requiresAuth: true,
        dataUrl: 'api/settings',
        pageTitle : 'Dashboard',
    }

},

{
    path: '/menu',
    component: MenuComponent,
    meta: {
        requiresAuth: true,
        dataUrl: 'menu',
        pageTitle : 'Menu List',
    }
},
    {
        path: '/role',
        component: RoleComponent,
        meta: {
            requiresAuth: true,
            dataUrl: 'role',
            pageTitle : 'Role List',
        }
    },

    {
        path: '/user',
        component: UserComponent,
        meta: {
            requiresAuth: true,
            dataUrl: 'user',
            pageTitle : 'Manage User',
        }
    },


    {
        path: '/permission',
        component: PermissionComponent,
        meta: {
            requiresAuth: true,
            dataUrl: 'permission',
            pageTitle : 'User Wise Permission',
        }
    },











];


// import Home from './components/Home.vue';
// import Login from './components/auth/Login.vue';
// import CustomersMain from './components/customers/Main.vue';
// import CustomersList from './components/customers/List.vue';
// import Dashboard from './components/customers/New.vue';
// import Customer from './components/customers/View.vue';

// export const routes = [
//     {
//         path: '/',
//         component: Home,
//         meta: {
//             // requiresAuth: true
//         }
//     },
//     {
//         path: '/dashboard',
//         component: Dashboard
//     },

//     {
//         path: '/login',
//         component: Login
//     },


//     {
//         path: '/customers',
//         component: CustomersMain,
//         meta: {
//             requiresAuth: true
//         },
//         children: [
//             {
//                 path: '/',
//                 component: CustomersList
//             },
//             // {
//             //     path: 'new',
//             //     component: NewCustomer
//             // },
//             {
//                 path: ':id',
//                 component: Customer
//             }
//         ]
//     }
// ];