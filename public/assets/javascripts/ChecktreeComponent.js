Vue.component('Checktree', {
  template: `
    <span class="ui-checktree">
      <div>
        <ul>
          <li v-for="(v, k) in value" :key="k">
            <input v-model="v.checked" 
            type="checkbox" 
            @input="toggleAll(v, v.submenu)">
            {{ v.title }}
            <ul v-if="v.submenu && v.submenu.length > 0">
              <li v-for="(v2, k2) in v.submenu" :key="k2">
                <input v-model="v2.checked" type="checkbox">
                {{ v2.title }}
              </li>
            </ul>
          </li>
        </ul>
      </div>

      <InvalidFeedback v-if="invalidSource && invalidSource.status == 422"
      :data-field="invalidField" 
      :data-source="invalidSource.data" />
    </span>
  `,

  props: {
    value: Array,
    invalidField: String,
    invalidSource: Object,
  },

  mounted() {

    for (let menu of this.value) {
      if (menu.checked == 'false' || menu.checked == false) 
        menu.checked = undefined;

      if (menu.submenu) {
        for (let submenu of menu.submenu) {
          if (submenu.checked == 'false' || submenu.checked == false) 
            submenu.checked = undefined;
        }
      }
    }

  },

  methods: {
    toggleAll(menu, submenu) {
      if (!submenu) return;
       
      for (let m of submenu) {
        m.checked = !menu.checked
      }
    },
  },
});