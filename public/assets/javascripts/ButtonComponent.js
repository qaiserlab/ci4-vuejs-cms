Vue.component('Button_', {
  template: `
    <button :type="(submit)?'submit':'button'"
    class="ui-button btn"
    :class="\`btn-\$\{type\} btn-\$\{color\} btn-\$\{size\} \` + ((label)?'btn-label':'')"
    :disabled="disabled || loading"
    @click="handleClick">
      <Fa v-if="icon" :icon="icon" :loading="loading" />
      <slot />
      <span v-if="label">{{ label }}</span>
    </button>
  `,

  props: {
    to: String,
    icon: String,
    loading: Boolean,
    submit: {
      type: Boolean,
      default: false,
    },
    type: {
      type: String,
      default: 'normal',
    },
    color: {
      type: String,
      default: 'primary',
    },
    size: {
      type: String,
      default: 'md',
    },
    label: {
      type: String,
      default: '',
    },
    disabled: {
      type: Boolean,
      default: false,
    },
  },

  methods: {
    handleClick() {
      if (this.to) window.location = this.to;
      this.$emit('click');
    },
  },

});