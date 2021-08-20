Vue.component('Textarea_', {
  template: `
    <span class="ui-textarea">
      <textarea class="form-control"
      rows="10"
      :value="value"
      :placeholder="placeholder"
      @input="handleInput"
      @keyup="handleKeyup"
      @keydown="handleKeydown"
      @click="handleClick"></textarea>

      <InvalidFeedback v-if="invalidSource && invalidSource.status == 422"
      :data-field="invalidField" 
      :data-source="invalidSource.data" />
    </span>
  `,

  props: {
    value: String,
    placeholder: String,
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