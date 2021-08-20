Vue.component('Textbox', {
  template: `
    <span class="ui-textbox">
      <input ref="input"
      class="form-control"
      :value="value"
      :type="type" 
      :placeholder="placeholder"
      @input="handleInput"
      @keyup="handleKeyup"
      @keydown="handleKeydown"
      @keyup.enter="handleEnter"
      @click="handleClick">

      <InvalidFeedback v-if="invalidSource && invalidSource.status == 422"
      :data-field="invalidField" 
      :data-source="invalidSource.data" />
    </span>
  `,

  props: {
    value: String | Number,
    placeholder: String,
    invalidField: String,
    invalidSource: Object,

    focus: {
      type: Boolean,
      default: false,
    },
    
    type: {
      type: String,
      default: 'text',
    },
  },

  mounted() {
    if (this.focus) this.$refs.input.focus();
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

    handleEnter(event) {
      this.$emit('enter', event.target.value);
    },
    
    handleClick() {
      this.$emit('click');
    },
  },

});