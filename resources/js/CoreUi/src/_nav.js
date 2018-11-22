class menuItem{
  constructor(item){
    this.name = item.name
    this.url  = item.url
    this.icon = item.icon
  }
}

class menuBadge extends menuItem{
  constructor(item){
    super(item)
    this.badge = {
      variant: item.badgevariant,
      text: item.badgetext
    }
  }
}

class titleItem{
  constructor(item){
    this.title = true
    this.name = item.name
    this.wrapper = {
      element: null,
      attributes: {}
    }
    item.hasOwnProperty('class')? this.class = item.class : this.class= null
    item.hasOwnProperty('wrapel')? this.wrapper.element = item.wrapel:this.wrapper.element = null
    item.hasOwnProperty('wrapat')? this.wrapper.attributes = item.wrapat:this.wrapper.attributes = null
  }
}

var themeTitle = new titleItem({
  name : "Reservas",
  class: '',
  wrapel: '',
  wrapat: ''
})

var panelPrincipal = new menuBadge({
  name: 'Panel Principal', 
  url:'/dashboard',
  icon: 'icon-speedometer',
  badgevariant: 'primary',
  badgetext:'Nuevo'
})

var colors = new menuItem({
      name: 'Colors',
      url: '/theme/colors',
      icon: 'icon-drop'
    })

var typhography = new menuItem({
      name: 'Typography',
      url: '/theme/typography',
      icon: 'icon-pencil'
    })


var s_reserva = new menuItem({
      name: 'Solicitud de Reserva',
      url: '/reservas/nueva_reserva',
      icon: 'icon-pencil'
    })

export default {
  items: [
    panelPrincipal,
    themeTitle,
    colors,
    typhography,
    s_reserva,
    {
      divider: true
    },
    {
      title: true,
      name: 'Extras'
    },
  ]
}
