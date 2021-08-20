Vue.component('Hyperlink', {
  template: `
    <a href="javascript:"
    class="ui-link"
    :class="'text-' + color"
    @click="handleClick">
      <Fa v-if="icon" :icon="icon" :loading="loading" />
      <slot />
    </a>
  `,

  props: {
    to: String,
    icon: String,
    loading: Boolean,
    submit: {
      type: Boolean,
      default: false,
    },
    color: {
      type: String,
      default: 'primary',
    },
    // disabled: {
    //   type: Boolean,
    //   default: false,
    // },
  },

  methods: {
    handleClick() {
      if (this.to) window.location = this.to;
      this.$emit('click');
    },
  },

});