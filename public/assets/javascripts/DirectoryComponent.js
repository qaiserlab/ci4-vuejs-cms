Vue.component('Directory', {
  template: `
    <div class="ui-directory">
      <div class="left-pane">
        <button v-for="(record, key) in dataSource_" 
        type="button" 
        class="btn btn-ghost-secondary"
        :class="(record.o)?'active':''"
        :key="key"
        @click="handleClick(record)">
          <div>
            <i class="fa fa-folder-o"
            :class="(record.o)?'fa-folder-open-o':'fa-folder-o'"></i>
          </div>
          <div>
            {{ record.title }}
          </div>
        </button>
      </div>
      <div class="right-pane">
        <slot />
      </div>
    </div>
  `,

  props: {
    loading: Boolean,
    dataSource: Array,
  },

  data() {
    return {
      dataSource_: [],
    };
  },

  mounted() {
    this.init();
  },

  watch: {
    dataSource() {
      this.init();
    },
  },

  methods: {
    
    init() {
      this.dataSource_ = [];
  
      for (let i in this.dataSource) {
        this.dataSource_.push({
          ...this.dataSource[i],
          o: false,
        });
        if (i == 0) {
          this.dataSource_[i].o = true;
          this.$emit('click', this.dataSource_[i].id);
        }
      }    
    },

    handleClick(record) {
      for (let i in this.dataSource_) {
        if (this.dataSource_[i].id == record.id)
          this.dataSource_[i].o = true;
        else
          this.dataSource_[i].o = false;
      }
      this.$emit('click', record.id);
    },

  },
  
});