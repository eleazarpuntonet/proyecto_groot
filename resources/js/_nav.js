export default {
  items: [
  {
    title: true,
    name: 'Panel de Gestion',
    class: '',
    wrapper: {
      element: '',
      attributes: {}
    }
  },
    {//Dashboard
      name: 'Servicios IT',//<-- Asi se modifica el titulo de una seccion de botones
      class: 'nav-item nav-dropdown',
      url: '/',
      icon: 'icon-speedometer',
      badge: {
        variant: 'primary',
        text: 'NEW'
      },
      children:
      [{
        name: 'Credenciales',
        url: '/credenciales',
        icon: 'icon-key',
        children: [
          {
            name: 'Proveedores',
            url: '/credenciales/proveedores',
            icon: 'icon-key'
          },
          {
            name: 'Accesos',
            url: '/credenciales/accesos',
            icon: 'icon-key'
          },
          {
            name: 'Facturacion',
            url: '/credenciales/facturacion',
            icon: 'icon-key'
          },
          {
            name: 'Sitios',
            url: '/credenciales/sitios',
            icon: 'icon-key'
          },
        ]
      }]
    },
    {
      name: 'Download CoreUI',
      url: 'http://coreui.io/vue/',
      icon: 'icon-cloud-download',
      class: 'mt-auto',
      variant: 'success'
    },
    {
      name: 'Try CoreUI PRO',
      url: 'http://coreui.io/pro/vue/',
      icon: 'icon-layers',
      variant: 'danger'
    }
  ]
}
