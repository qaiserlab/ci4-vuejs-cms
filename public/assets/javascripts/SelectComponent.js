Vue.component('Select_', {
  template: `
    <span class="ui-select">
      <select class="form-control"
      :value="value"
      @change="handleInput"
      @keyup="handleKeyup"
      @keydown="handleKeydown"
      @click="handleClick">
        <option v-if="placeholder" value="">------ {{ placeholder }} ------</option>
        <option v-for="(record, key) in dataSource"
        :key="key"
        :value="(field)?record.id:record"
        :selected="(field)?record.id == value:record == value" >{{ (field)?record[field]:record }}</option>
      </select>

      <InvalidFeedback v-if="invalidSource && invalidSource.status == 422"
      :data-field="invalidField" 
      :data-source="invalidSource.data" />
    </span>
  `,

  props: {
    value: String | Number,
    field: String,
    placeholder: String,
    dataSource: Array,
    invalidField: String,
    invalidSource: Object,
  },

  methods: {
    handleInput(event) {
      this.$emit('input', event.target.value);
    },

    handleKeyup(event) {
      this.$emit('keyup', event.target.value);
    },

    handleKeydown(event) {
      this.$emit('keydown', event.target.value);
    },
    
    handleClick() {
      this.$emit('click');
    },
  },
});