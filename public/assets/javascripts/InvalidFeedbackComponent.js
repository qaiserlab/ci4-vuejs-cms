Vue.component('InvalidFeedback', {
  template: `
    <div class="ui-invalid-feedback invalid-feedback" style="display: block">
      {{message}}
    </div>
  `,

  props: {
    dataSource: Array,
    dataField: String,
  },

  computed: {
    message() {
      if (!this.dataSource) return '';

      // let record = this.dataSource.filter((record) => {
      //   return record.field == this.dataField;
      // });

      // return ((record[0])?record[0].message:'');

      let message = '';

      $.each(this.dataSource, (key, value) => {
        if (key == this.dataField) message = value;
      });

      return message;
    },
  },

  methods: {
    handleClick() {
      this.$emit('click');
    },
  },
  
});