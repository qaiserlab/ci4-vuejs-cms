Vue.component('Datepicker', {
  template: `
    <span class="ui-datepicker">
      <div v-if="type == 'daily' || type == 'monthly' || type == 'yearly'" 
      class="select yearly">
        <Select_ v-model="form.year" 
        field="text"
        :data-source="getYears()" 
        @input="handleInput" />
      </div>

      <div v-if="type == 'daily' || type == 'monthly'" 
      class="select monthly">
        <Select_ v-model="form.month" 
        field="text"
        :data-source="getMonths()" 
        @input="handleInput" />
      </div>

      <div v-if="type == 'daily'" 
      class="select daily">
        <Select_ v-model="form.day" 
        field="text"
        :data-source="getDays()" 
        @input="handleInput" />
      </div>

      <InvalidFeedback v-if="invalidSource && invalidSource.status == 422"
      :data-field="invalidField" 
      :data-source="invalidSource.data" />
    </span>
  `,

  props: {
    value: String,
    invalidField: String,
    invalidSource: Object,

    type: {
      type: String,
      default: 'daily'
    },
  },

  data() {
    const date = new Date();

    return {
      form: {
        year: date.getFullYear(),
        month: date.getMonth() + 1,
        day: date.getDate(),
      },
      monthRecords: [
        'January',
        'February',
        'March',
        'April',
        'May',
        'June',
        'July',
        'August',
        'September',
        'October',
        'November',
        'December',
      ],
    }
  },

  mounted() {
    this.init();
  },

  watch: {
    value() {
      this.init();
    },
  },

  methods: {
  
    init() {
      if (!this.value) return;
      const date = new Date(this.value);
      
      this.form.year = date.getFullYear();
      this.form.month = date.getMonth() + 1;
      this.form.day = date.getDate();
    },

    getYears() {
      const date = new Date();
      const currentYear = date.getFullYear();
      const firstYear = currentYear - 50;
      
      let years = [];
      let value = 0;

      for (let i = 1; i <= 100; i++) {
        value = firstYear + i;
        years.push({ id: value, text: value });
      }

      return years;
    },
    
    getMonths() {
      let i = 0;
      return [...this.monthRecords.map((value) => {
        i++;
        return { id: i, text: value };
      })]
    },

    getDays() {
      let days = [];
      for (let i = 1; i <= 31; i++) {
        days.push({ id: i, text: i });
      }
      return days;
    },

    handleInput(event) {
      let value = `${this.form.year}-${this.form.month}-${this.form.day}`;
      this.$emit('input', value);
    },

  },

});