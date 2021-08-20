Vue.component('Thumbnail', {
  template: `
    <span class="ui-thumbnail">
      <img v-if="value" :src="src" :class="'img-' + type">
    </span>
  `,

  props: {
    value: String,
    type: {
      type: String,
      default: 'thumbnail',
    },
  },

  computed: {
    src() {
      if (this.value)
        return baseURL('images/' + this.value);
      else 
        return '';
    },
  },
});