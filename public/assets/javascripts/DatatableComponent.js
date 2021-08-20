Vue.component('Datatable', {
  template: `
    <span ref="datatable" class="ui-datatable">
      <v-client-table class="table-sm table-responsive-sm" 
      :data="dataSource"
      :columns="columns"
      :options="options">
        <template v-for="(column, key) in customColumns" 
        :slot="column" 
        scope="data">
          <slot :name="column" :row="data.row"></slot>
        </template>
        
        <template slot="action" scope="data">
          <slot name="action" :row="data.row"></slot>
        </template>
      </v-client-table>
    </span>
  `,

  props: {
    dataSource: Array,
    columns: Array,
    customColumns: Array,
    options: Object,
    columnsOptions: Object,
  },

  mounted() {
    let option, span, formControl, placeholderOption;
    if (!this.columnsOptions) return;

    let $iconSort = $(this.$refs.datatable).find('.glyphicon.glyphicon-sort');
    $iconSort.removeClass('glyphicon');
    $iconSort.removeClass('glyphicon-sort');
    $iconSort.addClass('fa');
    $iconSort.addClass('fa-sort');
    
    $iconSort.parent().on('click', () => {
      let $iconSort = $(this.$refs.datatable).find('.glyphicon.glyphicon-sort');
      $iconSort.removeClass('glyphicon');
      $iconSort.removeClass('glyphicon-sort');
      $iconSort.addClass('fa');
      $iconSort.addClass('fa-sort');
      
      let $iconChevronUp = $(this.$refs.datatable).find('.glyphicon.glyphicon-chevron-up');
      $iconChevronUp.removeClass('glyphicon');
      $iconChevronUp.removeClass('glyphicon-chevron-up');
      $iconChevronUp.addClass('fa');
      $iconChevronUp.addClass('fa-sort-up');

      let $iconChevronDown = $(this.$refs.datatable).find('.glyphicon.glyphicon-chevron-down');
      $iconChevronDown.removeClass('glyphicon');
      $iconChevronDown.removeClass('glyphicon-chevron-down');
      $iconChevronDown.addClass('fa');
      $iconChevronDown.addClass('fa-sort-down');
    });
    
    for (let key of Object.keys(this.columnsOptions)) {
      option = this.columnsOptions[key];
      
      $(this.$refs.datatable).find('thead tr:first-child th').each((i, th) => {
        span = $(th).find('.VueTables__heading');
        if (span.html().toLowerCase() == key.toLowerCase()) {
          if (option.label) span.html(option.label);

          if (option.width) {
            span.parent().css('width', option.width);
          }
        }
      });

      $(this.$refs.datatable).find('thead tr:last-child th').each((i, th) => {
        formControl = $(th).find('.form-control');
        if (formControl.length > 0) {

          if (formControl.attr('placeholder')) {
            if (formControl.attr('placeholder').toLowerCase().indexOf(key.toLowerCase()) > -1) {
              if (option.label) formControl.attr('placeholder', 'Filter by ' + option.label);
            }
          }
          
          placeholderOption = formControl.find('option:first-child');
          if (placeholderOption.html()) {
            if (placeholderOption.html().toLowerCase().indexOf(key.toLowerCase()) > -1) {
              if (option.label) placeholderOption.html('Select ' + option.label);
            }
          }

        }
      });
    }

  },
  
});