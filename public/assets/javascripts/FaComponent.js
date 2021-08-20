Vue.component('Fa', {
  template: `
    <i class="ui-fa fa" :class="_icon"></i>
  `,

  props: {
    icon: {
      type: String,
      default: 'cube',
    },
    loading: Boolean,
  },

  computed: {
    _icon() {
      let icon = `fa-${this.icon}`;
      if (this.loading) icon = 'fa-spin fa-circle-o-notch';

      return icon;
    },
  },
});