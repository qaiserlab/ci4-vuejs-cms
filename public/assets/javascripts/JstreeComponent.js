Vue.component('Jstree', {
  template: `
    <span class="ui-tredit">
      <div class="tr-container" @dblclick="editData">
        <div ref="jstree"></div>
      </div>
      <div>
        <Button_ icon="plus" @click="addData" :disabled="checkbox" />&nbsp;
        <Button_ icon="edit" type="info" @click="editData" :disabled="checkbox" />&nbsp;
        <Button_ icon="minus" type="danger" @click="deleteData" :disabled="checkbox" />

        <span class="right-pane">
          <Button_ icon="arrow-up" type="success" @click="moveUpData" :disabled="checkbox" />&nbsp;
          <Button_ icon="arrow-down" type="success" @click="moveDownData" :disabled="checkbox" />&nbsp;
          <!-- <Button_ v-if="displayLock"
          type="warning" 
          :icon="(!checkbox)?'lock':'check'"
          @click="toggleCheckbox" /> -->
        </span>
      </div>

      <InvalidFeedback v-if="invalidSource && invalidSource.status == 422"
      :data-field="invalidField" 
      :data-source="invalidSource.data" />

      <Modal :title="(mode == 'ADD')?'Add':'Edit'" 
      size="md"
      :display="dialog" 
      @close="dialog = false">

        <div class="row">
          <div class="col-md-12">
            <div class="form-group">
              <select v-model="form.parent"
              class="form-control">
                <option value="#">ROOT</option>
                <option v-for="(row, key) in _items" 
                :value="row.id"
                :key="key">{{ row.text }}</option>
              </select>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-md-12">
            <div class="form-group">
              <Textbox v-model="form.text"
              placeholder="Title" />
            </div>
          </div>
        </div>
        
        <div class="row">
          <div class="col-md-12">
            <div class="form-group">
              <Textbox v-model="form.url"
              placeholder="URL" />
            </div>
          </div>
        </div>
        
        <div class="row">
          <div class="col-md-12">
            <div class="form-group">
              <Textbox v-model="form._icon"
              placeholder="Icon" />
            </div>
          </div>
        </div>

        <div slot="footer">
          <Button_ icon="floppy-o" 
          :disabled="!form.text"
          @click="saveData">Save</Button_>&nbsp;
          <Button_ icon="close" type="danger" @click="dialog = false">Cancel</Button_>
        </div>
      </Modal>
    </span>
  `,

  props: {
    value: Array,
    field: String,
    invalidField: String,
    invalidSource: Object,
  },

  data() {
    return {
      instance: {},
      checkbox: false,
      displayLock: true,
      dialog: false,
      firstValue: true,
      mode: '',
      id: 0,
      form: {
        id: '',
        parent: '',
        text: '',
        url: '',
        _icon: '',
        checked: true,
      },
      items: [],
    };
  },

  computed: {

    _items() {
      return this.items.filter((item) => {
        return item.parent == '#';
      });
    },

  },

  mounted() {
    this.initValue();
    this.init();
  },

  watch: {

    items() {
      if (!this.firstValue) {
        
        let value = [];
        let submenu, checkeds, checked, item, i, subIndex;
        
        i = -1;
        // checkeds = this.instance.jstree('get_checked', null, true)

        for (let item of this._items) {
          i++;

          submenu = this.getItemsByParent(item.id);
          value.push({
            title: item.text,
            // title: item.title,
            url: item.url,
            _icon: item._icon,
            checked: item.checked,
            submenu,
          });
        }

        this.init();
        this.$emit('input', value);
      }
    },
  },

  methods: {

    initValue() {
      if (this.firstValue) {
        let parentId;
        let values = (this.value)?this.value:[];

        for (let item of values) {

          this.id++;
          this.items.push({
            id: this.id,
            parent: '#',
            text: item.title,
            url: item.url,
            _icon: item._icon,
            checked: item.checked,
          });

          parentId = this.id;

          let submenu = (item.submenu)?item.submenu:[];
          submenu.forEach((submenuItem) => {
            this.id++
            this.items.push({
              id: this.id,
              parent: parentId,
              text: submenuItem.title,
              url: submenuItem.url,
              _icon: submenuItem._icon,
              checked: submenuItem.checked,
            });
          });

        }

        this.init();
        this.firstValue = false;
      }
    },

    init() {
      let plugins = ['wholerow'];
      if (this.checkbox) plugins.push('checkbox');

      this.instance = $(this.$refs.jstree);

      this.instance.jstree('destroy');
      
      return this.instance.jstree({ 
        plugins,
        core: {
          // 'data' : [
          //   { "text" : "Root node", "children" : [
          //       { "text" : "Child node 1" },
          //       { "text" : "Child node 2" }
          //     ]
          //   }
          // ]
          data: this.items,
          // themes: {
          //   name: 'proton',
          //   responsive: true,
          // }
        },
      }).on('loaded.jstree', () => {
        this.instance.jstree('open_all');
      });
    },

    getItemsByParent(parent) {
      let items = this.items.filter((item) => {
        return item.parent == parent;
      })
      return items.map((item) => {
        item.title = item.text;
        return item;
      });
    },
    
    addData() {
      this.mode = 'ADD';

      this.form.parent = '#';
      this.form.text = '';
      this.form.url = '';
      this.form._icon = '';

      this.dialog = true;
    },
    
    editData() {
      const id = this.instance.jstree("get_selected")[0];
      if (!id) return;

      this.mode = 'EDIT';
      let item;

      for (let _item of this.items) {
        if (_item.id == id) item = _item;
      }

      this.form.id = id;
      this.form.parent = item.parent;
      this.form.text = item.text;
      this.form.url = item.url;
      this.form._icon = item._icon;

      this.dialog = true;
    },

    deleteData() {
      const id = this.instance.jstree("get_selected")[0];
      if (!id) return;

      confirm('Delete choosed item?', () => {
        this.items = this.items.filter((item) => {
          return item.id != id && item.parent != id;
        });
      });
    },

    saveData() {
      if (this.mode == 'ADD') {
        this.id++;

        this.form.id = this.id;
        this.items.push({...this.form});
        this.form.text = '';
        this.form.url = '';
        this.form._icon = '';
      }
      else {
        const id = this.instance.jstree("get_selected")[0];
        let i = -1;

        for (let item of this.items) {
          i++;
          if (item.id == id) {
            this.items.splice(i, 1, {...this.form});
          }
        }

        this.dialog = false;
      }

    },

    toggleCheckbox() {
      let values = [...this.value];
      let value, item, checkeds, checked, i, subIndex, submenu;
      
      if (this.checkbox) {
        confirm('Apply all checked/unchecked items?', () => {
          this.checkbox = false;
          
          checkeds = this.instance.jstree('get_checked', null, true);

          i = -1;
          for (value of values) {
            i++;
            value.checked = false;

            for (submenu of value.submenu) {
              submenu.checked = false;
            }
          }

          for (checked of checkeds) {
            i = -1;
            subIndex = -1;

            for (value of this.items) {               
              if (value.parent == '#') {
                i++;
                subIndex = -1;
              }
              else subIndex++;

              if (values[i]) {
                // console.log('VALUE ID: ' + value.id + ' CHECKED: ' + checked + ' TEXT: ' + value.text)
                
                if (value.id == checked && value.parent == '#')
                  values[i].checked = true;
                
                if (value.id == checked && value.parent != '#' && values[i].submenu[subIndex])
                  values[i].submenu[subIndex].checked = true;
              
              }
            }
          }

          this.init();
          this.$emit('input', values);
          
          this.$emit('lock');
          this.displayLock = false;
        });
      }
      else {
        this.checkbox = true;
        const instance = this.init();

        instance.on('loaded.jstree', () => {
          checkeds = [];

          for (item of this.items) {
            if (item.checked == true) checkeds.push(item.id);
          }

          this.instance.jstree(true).select_node(checkeds);
        });

        this.$emit('unlock');
      }
    },

    moveUpData() {
      const id = this.instance.jstree("get_selected")[0];
      if (!id) return;

      let i = -1;
      for (let item of this.items) {
        i++;
        if (i > 0 && item.id == id) {
          let itemBefore;
          
          let index;
          for (index = (i - 1); index >= 0; index--) {
            itemBefore = this.items[index];
            if (itemBefore.parent == item.parent) break;
          }

          if (itemBefore && (itemBefore.parent == item.parent)) {
            this.items.splice(index, 1, {...item});
            this.items.splice(i, 1, {...itemBefore});
          }

          break;
        }
      }
    },
    
    moveDownData() {
      const id = this.instance.jstree("get_selected")[0];
      if (!id) return;

      let i = -1;
      for (let item of this.items) {
        i++;
        if (item.id == id) {
          let itemAfter;

          let index;
          for (index = (i + 1); index < this.items.length; index++) {
            itemAfter = this.items[index];
            if (itemAfter.parent == item.parent) break;
          }

          if (itemAfter && (itemAfter.parent == item.parent)) {
            this.items.splice(i, 1, {...itemAfter});
            this.items.splice(index, 1, {...item});
          }
          
          // this.$nextTick(() => 
            // this.instance.jstree(true).select_node(item.id)
          // })
          break;
        }
      }
    },

  },
  
});