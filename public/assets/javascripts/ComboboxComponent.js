Vue.component('Combobox', {
  template: `
    <span class="ui-combobox">
      <div ref="toggler" class="input" @click="toggleDropdown">
      <span class="placeholder"
        v-if="!value && placeholder">------ {{ placeholder }} ------</span>
        <span v-if="value">{{ text }}</span>
        <i class="fa fa-chevron-down"></i>
      </div>

      <div v-show="dropdown" 
      v-closable="{
        exclude: ['toggler'],
        handler: 'closableHandler'
      }"
      class="dropdown">
        <div class="search-area">
          <input v-model="keyword" ref="search" type="text" :autocomplete="getRandomString()">
        </div>

        <div>
          <a href="javascript:"
          @click="select('')">------ {{ placeholder }} ------</a>

          <a v-for="(record, key) in dataSource_"
          href="javascript:"
          :key="key"
          @click="select((field)?((!fieldValue)?record.id:record[fieldValue]):record)">{{ (field)?record[field]:record }}</a>
        </div>
      </div>

      <InvalidFeedback v-if="invalidSource && invalidSource.status == 422"
      :data-field="invalidField" 
      :data-source="invalidSource.data" />
    </span>
  `,

  props: {
    value: String | Number,
    field: String,
    fieldValue: String,
    placeholder: String,
    dataSource: Array,
    invalidField: String,
    invalidSource: Object,
  },

  data() {
    return {
      keyword: '',
      dropdown: false,
    };
  },

  computed: {
    text() {
      let key, record, value, text;
    
      for (record of this.dataSource) {
        value = (this.field)?((!this.fieldValue)?record.id:record[this.fieldValue]):record;
        if (value == this.value) {
          text = (this.field)?record[this.field]:record;
          break;
        }
      }

      return text;
    },

    dataSource_() {
      let text;

      if (!this.dataSource) return [];
      return this.dataSource.filter((record) => {
        text = (this.field)?record[this.field]:record;
        text = text.substr(0, this.keyword.length);
        return (text.toLowerCase() == this.keyword.toLowerCase());
      })
    },
  },

  mounted() {
    // $(window).off('click');
    // $(window).on('click', this.release.bind(this));
  },
  
  methods: {

    getRandomString() {
      return Math.random().toString(36).replace(/[^a-z]+/g, '').substr(0, 5);
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

    select(value) {
      this.$emit('input', value);
      this.dropdown = false;
    },

    toggleDropdown() {
      this.dropdown = !this.dropdown;

      this.keyword = '';
      this.$nextTick(() => {
        $(this.$refs.search).focus();
      })
    },

    closableHandler() {
      this.dropdown = false;
    },

  },
});