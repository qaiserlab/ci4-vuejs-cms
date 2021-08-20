Vue.component('Alert', {
  template: `
    <div class="ui-alert alert alert-danger">
      <button type="button" 
      class="close"
      @click="handleClose">
        <i class="fa fa-close"></i>
      </button>
      <h5 v-if="title">{{ title }}</h5>
      <slot />
      <div v-if="dataSource_.length > 0">
        <br>
        <ul>
          <li v-for="(value, key) in dataSource_"
          :key="key">
            {{ value }}
          </li>
        </ul>
      </div>
    </div>
  `,

  props: {
    title: String,
    dataSource: {
      type: Array,
      default: () => [],
    },
  },

  computed: {
    dataSource_() {
      let data = [];
      $.each(this.dataSource, (i, value) => {
        data.push(value);
      });
      return data;
    },
  },

  methods: {

    handleClose() {
      this.$emit('close');
    },

  },
  
});