
export default [
  /*,*/
  {
    path: '/',
    component: () => import('pages/entrar'),
  },
  {
    path: '/admin',
    component: () => import('layouts/default'),
    children: [
      { path: '', component: () => import('pages/admin') }
    ]
  },

  { // Always leave this as last one
    path: '*',
    component: () => import('pages/404')
  }
]
