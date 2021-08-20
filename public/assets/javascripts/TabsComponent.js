Vue.component('Tabs', {
  template: `
    <div class="ui-tabs">
      <ul class="nav nav-tabs">
        <li v-for="(record, key) in dataSource_" 
        :key="key"
        class="nav-item">
          <a class="nav-link"
          href="javascript:" 
          :class="(record.o)?'active':''"
          @click="handleClick(record)">
            <div>
              {{ (record.title)?record.title:record.nama }}
            </div>
          </a>
        </li>
      </ul>
      <div class="content">
        <br>
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
    }
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