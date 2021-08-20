Vue.component('Gallery', {
  template: `
    <div class="ui-gallery">
      <figure v-if="!button" :style="{ 'min-height': minHeight }"
      @click="handleClick">
        <img v-if="src" :src="src" >
        <a href="javascript:">
          <i><Fa icon="image" /> Click Area to Add/Replace Image</i>
        </a>
      </figure>
      <a v-else class="btn" href="javascript:" @click="browse = true">
        <slot />
      </a>

      <InvalidFeedback v-if="invalidSource && invalidSource.status == 422"
      :data-field="invalidField" 
      :data-source="invalidSource.data" />

      <Modal title="Browse" 
      size="lg"
      class="browser"
      :display="browse" 
      @close="browse = false">
        
        <Directory :data-source="albums_" @click="openAlbum">
          <div v-for="(album, key) in albums_" 
          :key="key">

            <div v-if="albumIdActive == album.id">
              <h4>{{ album.title }}</h4>
              <header>
                <Uploader :store-archive="true" 
                :store-id="storeId"
                :store-slug="storeSlug"
                :preview="false" 
                @uploaded="refreshData" />
              </header>
              <br>

              <section class="row">
                
                <div v-for="(record, key) in recordsActive" 
                class="col-md-3"
                :key="key">
                  <a href="javascript:" 
                  class="img-thumbnail" 
                  @click="handleInput(record)">
                    <img :src="getArchivesURL(record.file)">
                  </a>

                  <footer>
                    <Hyperlink icon="files-o" 
                    @click="copyUrl(record.file)" />

                    <Hyperlink icon="close"
                    color="danger" 
                    @click="deleteData(record)" />
                  </footer>
                </div>

                <footer v-if="isMore">
                  <hyperlink 
                  @click="pageActive++">More...</hyperlink>
                </footer>

              </section>

            </div>

          </div>

        </Directory>

        <div slot="footer">
          <Button_ type="danger" 
          icon="close"
          @click="browse = false">Close</Button_>
        </div>
      </Modal>

    </div>
  `,

  props: {
    value: String,
    placeholder: String,
    invalidField: String,
    invalidSource: Object,
    button: false,
    
    minHeight: {
      type: String,
      default: '240px',
    },
    storeSlug: String,
  },

  data() {
    return {
      src: '',

      loading: false,
      browse: false,
      
      storeId: -1,
      recordActive: {},
      albumIdActive: -1,

      pageActive: 1,
      pageRange: 8,

      albums: gRsAlbum,
      records: gRsPhoto,
    };
  },

  computed: {
    // ...mapGetters('Album', {
    //   albums: 'records',
    // }),
    // ...mapGetters('Photo', [
    //   'records',
    // ]),

    isMore() {
      const range = this.pageActive * this.pageRange;
      return this.recordsActive_.length > range;
    },

    recordsActive_() {
      return this.records.filter((record) => {
        return record.albumId == this.albumIdActive;
      });
    },

    recordsActive() {
      const range = this.pageActive * this.pageRange;
      
      let _records = [];
      for (let i = 0; i < this.recordsActive_.length; i++) {
        if (i >= range) break;
        _records.push(this.recordsActive_[i]);
      }

      return _records;
    },

    albums_() {
      let album;
      let albums = this.albums.filter((record) => {
        if (record.slug == this.storeSlug) album = record;
        return record.slug != this.storeSlug;
      })

      if (album) {
        this.storeId = album.id;
        albums.unshift(album);
      }

      return albums;
    }
  },

  mounted() {
    this.init();
  },

  watch: {
    value() {
      this.init();
    },

    $route(to, from) {
      this.init();
    },
  },

  methods: {
    // ...mapActions('Album', {
    //   fetchAlbums: 'fetchRecords',
    // }),
    // ...mapActions('Photo', [
    //   'fetchRecords',
    //   'moveRecordById',
    //   'deleteRecord',
    // ]),
    // fetchAlbums() {},
    async fetchRecords() {
      await $.get(baseURL('dashboard/archive/read'), (result) => {
        this.records = result.data;
      });
    },

    // moveRecordById() {
    // },
    async deleteRecord(id) {
      await $.get(baseURL('dashboard/archive/remove?id=' + id), (result) => {
        splash('Photo has been removed');
      });
    },

    async init() {
      // if (this.records.length == 0)
      await this.refreshData();

      if (this.value)
        this.src = baseURL('images/' + this.value);
      else
        this.src = '';
    },

    async refreshData() {
      this.loading = true;
      this.pageActive = 1;
      await this.fetchRecords();
      // await this.fetchAlbums();
      this.loading = false;
    },
    
    async deleteData(record) {
      this.browse = false;

      confirm('Delete choosed data?', async () => {
        this.deleteLoading = true;

        // this.moveRecordById(record.id);
        await this.deleteRecord(record.id);
        await this.fetchRecords();
        
        this.deleteLoading = false;
        this.browse = true;
      }, () => { this.browse = true; })
    },

    addData() {
      // console.log('test');
    },

    openAlbum(key) {
      // this.recordsActive = this.records.filter((record) => {
        //   return record.albumId == key;
      // });
      
      this.storeId = key;

      this.pageActive = 1;
      this.albumIdActive = key;
    },

    getArchivesURL(URI) {
      return baseURL('images/' + URI);
      // return `${ApiConfig.archivesURL}/${URI}`;
    },

    handleClick() {
      this.browse = true;
      this.$emit('click');
    },
    
    handleInput(record) {
      this.browse = false;

      this.src = baseURL('images/' + record.file);
      this.$emit('input', record.file);
    },

    copyUrl(file) {
      if (this.copyToClipboard(this.getArchivesURL(file)))
        splash('URL address of the file has been copied');
      else
        splash('Copying failed');
    },

    copyToClipboard(text) {
      if (window.clipboardData && window.clipboardData.setData) {
        // Internet Explorer-specific code path to prevent textarea being shown while dialog is visible.
        return clipboardData.setData("Text", text);
      }
      else if (document.queryCommandSupported && document.queryCommandSupported("copy")) {
        let textarea = document.createElement("textarea");
        textarea.textContent = text;
        textarea.style.position = "fixed";  // Prevent scrolling to bottom of page in Microsoft Edge.
        document.body.appendChild(textarea);
        textarea.select();
        try {
          return document.execCommand("copy");  // Security exception may be thrown by some browsers.
        }
        catch (ex) {
          console.warn("Copy to clipboard failed.", ex);
          return false;
        }
        finally {
          document.body.removeChild(textarea);
        }
      }
    },

  },
  
});