Vue.component('SubscribeWidget', {
  template: `
  <form class="form-inline" @submit.prevent="submit">
    <textbox v-model="form.email"
    invalid-field="email" 
    placeholder="Type your Email..." 
    :invalid-source="response"></textbox> 
    &nbsp;

    <button_ icon="paper-plane"  
    :loading="loading"
    submit>
      Subscribe
    </button_>
  </form>
  `,

  data() {
    return {
      loading: false,
      response: {},
      form: {
        email: '',
      },
    };
  },

  methods: {

    async submit() {
      this.loading = true;
      
      $.post(baseURL('subscribe/send-email'), this.form, (result) => {
        this.response = result;
        this.loading = false;

        if (this.response.status == 200) {
          alert('Congratulations, your email has been registered to be subscriber');
          this.form.email = '';
        }
      });
    },

  },
});

new Vue({ el: '#subscribe-widget' });