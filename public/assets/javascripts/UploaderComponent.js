
Vue.component('Uploader', {
  template: `
    <span class="ui-uploader">
      <i v-if="loading" class="fa fa-spin fa-circle-o-notch"></i>

      <img v-if="preview && (src || file.destination)"
      :src="(file.destination)?file.destination:src" >

      <input type="file" 
      @change="handleInput">

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

    type: {
      type: String,
      default: 'image'
    },
    preview: {
      type: Boolean,
      default: true,
    },
    storeArchive: {
      type: Boolean,
      default: false,
    },
    storeId: {
      type: Number,
      default: 1,
    },
    storeSlug: String,
  },

  data() {
    return {
      loading: false,
  
      src: '',
      file: {
        filename: '',
        destination: '',
      },
    };
  },

  watch: {
    
    value() {
      this.init();
    },

    file() { 
      this.$emit('input', this.file.filename);
    },

  },

  mounted() {
    if (this.value)
      this.src = baseURL('images/' + this.value);
    else
      this.src = '';
  },

  methods: {

    // uniqid(length){
    //   let dec2hex = []
    //   let i

    //   for (i=0; i<=15; i++) {
    //     dec2hex[i] = i.toString(16);
    //   }

    //   let uuid = ''
    //   for (i=1; i<=36; i++) {
    //     if (i===9 || i===14 || i===19 || i===24) {
    //       uuid += '-'
    //     } else if (i===15) {
    //       uuid += 4
    //     } else if (i===20) {
    //       uuid += dec2hex[(Math.random()*4|0 + 8)]
    //     } else {
    //       uuid += dec2hex[(Math.random()*16|0)]
    //     }
    //   }

    //   if(length) uuid = uuid.substring(0,length)
    //   return uuid
    // },

    handleInput(event) {
      this.loading = true;

      let url = 'dashboard/archive/upload';
      const file = event.target.files[0];
      const data = new FormData();

      data.append('file', file);
      if (this.storeArchive) {
        // url += '?storeArchive=1&key=' + ApiConfig.key + '&token=' + localStorage.token + '&storeId=' + this.storeId;
        url += '?storeArchive=1&storeId=' + this.storeId;
      }

      $.ajax({
        method: 'POST',
        cache: false,
        contentType: false,
        processData: false,
        url: baseURL(url),
        data,
        success: (response) => {
          this.loading = false;
          // response.destination = response.destination.replace(
          //   './public', 
          //   baseURL(''),
          // );
          
          this.src = '';
          this.file = response;

          this.$emit('uploaded');
        }
      });
    },
    
    handleClick() {
      this.$emit('click');
    },

  },

});