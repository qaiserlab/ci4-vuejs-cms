Vue.component('Label_', {
  template: `
    <span class="ui-label">
      <span v-if="(type == 'html' || type == 'multiline' || type == 'status' || type == 'email')" v-html="value_"></span>
      <span v-else>{{ value_ }}</span>
      <b v-if="unit"><small>{{ unit }}</small></b>
    </span>
  `,

  props: {
    value: String | Number | Date,
    unit: String,

    daily: {
      type: Boolean,
      default: false
    },

    type: {
      type: String,
      default: 'text'
    },
  },

  computed: {
    value_() {
      let value, value_
      const dayNames = [
        'Minggu',
        'Senin',
        'Selasa',
        'Rabu',
        'Kamis',
        "Jum'at",
        'Sabtu',
      ];
      const monthNames = [
        'Januari',
        'Februari',
        'Maret',
        'April',
        'Mei',
        'Juni',
        'Juli',
        'Agustus',
        'September',
        'Oktober',
        'Nopember',
        'Desember'
      ];
      
      if (this.value) {
        value = this.value;
        
        switch (this.type) {
          case 'currency':
            value = parseInt(value).formatMoney(2, 3, '.', ',');
            break;
          case 'multiline':
            value = value.replace(/\n/g, '<br>');
            break;
          case 'date':
            if (!(value instanceof Date)) value = new Date(value);
            
            value_ = value.getDate() + ' ' + monthNames[value.getMonth() - 1] + ' ' + value.getFullYear();
            if (this.daily) value_ = dayNames[value.getDay()] + ', ' + value_;

            value = value_;
            break;

          case 'status':
            value = `
            <span class="badge badge-${getStatusColor(value)}">
              ${value}
            </span>`;
            break;
          
          case 'email':
            value = `
            <a href="mailto:${value}">
              ${value}
            </a>`;
            
        }
      }
      else {
        value = '-';
      }

      return value;
    },
  },
  
});