Vue.component('Card', {
  template: `
    <div class="ui-card card">
      <div v-if="header" class="card-header">
        <strong>{{ title }}</strong>
      </div>
      <div class="card-body">
        <slot />
        <div v-if="loading" class="card-loading">
          <i class="fa fa-spin fa-circle-o-notch"></i>
        </div>
      </div>
      <div v-if="footer" class="card-footer">
        <slot name="footer" />
      </div>
    </div>
  `,

  props: {
    header: {
      type: Boolean,
      default: true,
    },
    footer: {
      type: Boolean,
      default: false,
    },
    loading: {
      type: Boolean,
      default: false,
    },
    title: String,
  },
});