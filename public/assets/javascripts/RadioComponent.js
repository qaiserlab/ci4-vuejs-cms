Vue.component('Radio', {
  template: `
    <span class="ui-radio">
      <div v-for="(record, key) in dataSource"
      class="radio"
      :key="key">
        <label>
          <input type="radio" 
          :name="name" 
          :value="(field)?record.id:record"
          :checked="(value == ((field)?record.id:record))"
          @change="handleInput">
          {{ (field)?record[field]:record }}
        </label>
      </div>

      <InvalidFeedback v-if="invalidSource && invalidSource.status == 422"
      :data-field="invalidField" 
      :data-source="invalidSource.data" />
    </span>
  `,

  props: {
    value: String,
    field: String,
    placeholder: String,
    dataSource: Array,
    invalidField: String,
    invalidSource: Object,
  },

  data() {
    return {
      name: '',
    };
  },

  mounted() {
    this.name = this.generateName(10);
  },

  methods: {
    generateName(length) {
      let result = '';
      let characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
      let charactersLength = characters.length;

      for ( let i = 0; i < length; i++ ) {
        result += characters.charAt(Math.floor(Math.random() * charactersLength));
      }

      return result;
    },

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