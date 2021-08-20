Vue.component('Modal', {
  template: `
    <div class="ui-modal" v-if="display">
      <div class="modal-overlay"></div>

      <div class="modal" 
      tabindex="-1" 
      role="dialog"
      :style="{display: (display)?'block':'' }">
        <div class="modal-dialog" role="document" :class="'modal-' + size">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">{{ title }}</h5>
              <button type="button" 
              class="close" 
              aria-label="Close"
              @click="handleClose">
                <i class="fa fa-close"></i>
              </button>
            </div>
            <div class="modal-body">
              <slot />
            </div>
            <div class="modal-footer">
              <slot name="footer" />
            </div>
          </div>
        </div>
      </div>
    </div>
  `,

  props: {
    title: {
      type: String,
      default: 'Title',
    },

    display: {
      type: Boolean,
      default: false,
    },

    size: {
      type: String,
      default: 'md',
    },
  },

  methods: {
    handleClose() {
      this.$emit('close');
    },
  },
  
});