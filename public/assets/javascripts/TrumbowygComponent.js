Vue.component('Trumbowyg', {
  template: `
    <span class="ui-trumbowyg">
      <textarea ref="textarea"></textarea>

      <InvalidFeedback v-if="invalidSource && invalidSource.status == 422"
      :data-field="invalidField" 
      :data-source="invalidSource.data" />
    </span>
  `,

  props: {
    value: String,
    invalidField: String,
    invalidSource: Object,
  },

  data() {
    return {
      $trumbowyg: {},
    };
  },

  mounted() {
    this.$trumbowyg = $(this.$refs.textarea).trumbowyg({
      btnsDef: {
        image: {
          dropdown: ['insertImage', 'noembed'],
          ico: 'insertImage'
        }
      },

      btns: [
        // ['upload'],
        ['viewHTML'],
        ['historyUndo','historyRedo'],
        // ['undo', 'redo'], // Only supported in Blink browsers

        ['formatting'],
        ['fontsize'],
        ['strong', 'em', 'del'],
        ['superscript', 'subscript'],
        ['foreColor', 'backColor'],
        
        ['justifyLeft', 'justifyCenter', 'justifyRight', 'justifyFull'],
        
        ['unorderedList', 'orderedList'],
        ['table'],
        ['link'],
        ['image'],
        ['horizontalRule'],
        
        ['removeformat'],
        ['fullscreen'],
      ],
    });

    this.$trumbowyg.on('tbwinit', this.init.bind(this));
    this.$trumbowyg.on('tbwchange', this.handleInput.bind(this));
  },

  watch: {
    $route(to, from) {
      this.init();
    },
  },

  methods: {
    
    init() {
      this.$trumbowyg.trumbowyg('html', (this.value)?this.value:'');
    },

    handleInput(event) {
      this.$emit('input', this.$trumbowyg.trumbowyg('html'));
    },

  },
  
});