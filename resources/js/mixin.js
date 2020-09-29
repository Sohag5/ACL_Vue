export default {
	data(){
		return{
            httpRequest: false,
            DataList: [],
            allReturnData: [],
            Filter: {},
            filter: {},
            isLoaded: false,
            formDataArray: {},
            image_upload: {
                is_active: false,
                progress: 0,
                file: null,
                image_id: 0,
            },
            activeFormType: 1,
            activeModal: '',
            modalForm: false,
            RequiredDataList: [],
            imageData: [],
            currentUpdateId: null,
            loadHtml: '',
            DetailsData: [],
            changedFieldName: [],
            headerInfo: {},
            permissions: {},
            currentSerial: 0,
            modalTitle: '',
            formDataList: [],
        }
    },
    methods:{

      openModal(modalId,title = ''){

         this.activeModal = modalId;
         this.modalForm = true;
         this.$set(this.$store.state, 'activeModal', modalId);
         this.$set(this.$store.state, 'modalTitle', title);
         $('#' + modalId).modal('show');

     },


     closeModal(modalId = this.$store.state.activeModal) {
        $('#' + modalId).modal('hide');
        this.$set(this.$store.state, 'activeFormType', 1);
        this.formDataArray = {};
    },

    submitForm(formData = this.formDataArray, redirect_path=false, url=false){
        if (this.$store.state.activeFormType === 1) {
            this.insertData(formData, redirect_path, url);
        } else {
            this.updateData(formData, redirect_path, url);
        }
    },
    insertData: function (formData, redirect_path, url) {
        const  _this = this;
        var urlPostfix = '';
        if (url) {
            urlPostfix = url;
        } else {
            urlPostfix =  this.dataUrl();
        }
        const URL = this.$store.state.baseUrl + 'auth/' + urlPostfix;

        // console.log(URL);

        var form_data = Object.assign(formData, this.imageData);
        // console.log(form_data);
        this.$validator.validate().then(valid => {
            if (valid) {
                this.$store.state.httpRequest = true;
                axios.post(URL, form_data).then((response) => {
                    if (parseInt(response.data.code) === 7000) {
                        this.$swal({title: 'Warning', text: response.data.message, icon: 'warning',})
                    }

                    this.$store.state.httpRequest = false;
                    // console.log(response);
                    if (parseInt(response.data.code) === 2000) {
                        this.$validator.reset();
                        this.$swal({title: 'Success', text: response.data.message, icon: 'success'});
                        this.$store.state.activeFormType = 1;
                        if (this.modalForm === true) {
                            $('#' + this.$store.state.activeModal).modal('hide');
                            this.getDataList();
                        }
                        this.imageData = [];
                        this.formData = {};
                        this.formDataArray = {};
                        if (redirect_path) {
                            this.$router.push({path: redirect_path});
                        }
                    } else if (parseInt(response.data.status) === 3000) {
                        _this.$store.state.httpRequest = false;
                        this.$swal({title: 'Warning', text: response.data.message, icon: 'warning',})
                    } else {
                        _this.$store.state.httpRequest = false;
                        this.$swal({title: 'Warning', text: response.data.message, icon: 'warning',})
                    }
                }).catch(function (error) {
                    console.log(error);
                    _this.$store.state.httpRequest = false;
                    Vue.swal({title: 'Error', text: 'Whoops..!! something went wrong', icon: 'error'});
                });
            }
        });
    },
    updateData: function (formData, redirect_path, url) {
          const  _this = this;
        if (url) {
            var urlPostfix = url;
        } else {
            var urlPostfix = this.dataUrl() + '/' + this.$store.state.currentUpdateId;
        }
        const URL =  this.$store.state.baseUrl + 'auth/' + urlPostfix;
        var form_data = Object.assign(formData, this.imageData);
        this.$validator.validate().then(valid => {
            if (valid) {
                this.$store.state.httpRequest = true;
                axios.put(URL, form_data).then((response) => {
                    this.$store.state.httpRequest = false;

                    if (parseInt(response.data.code) === 7000) {
                        this.$swal({title: 'Warning', text: response.data.message, icon: 'warning',})
                    }


                    if (parseInt(response.data.code) === 2000) {
                        this.$validator.reset();
                        this.$store.state.activeFormType = 1;
                        if (this.modalForm === true) {
                            $('#' + this.$store.state.activeModal).modal('hide');
                            this.getDataList();
                        }
                        this.$swal({title: 'Success', text: response.data.message, icon: 'success'});
                        this.imageData = [];
                        this.formData = {};
                        this.formDataArray = {};
                        if (redirect_path) {
                            this.$router.push({path: redirect_path});
                        }
                    } else if (parseInt(response.data.code) === 3000) {
                        _this.$store.state.httpRequest = false;
                        this.$swal({title: 'Warning', text: response.data.message, icon: 'warning',})
                    } else {
                        _this.$store.state.httpRequest = false;
                        this.$swal({title: 'Warning', text: response.data.message, icon: 'warning',});
                    }
                }).catch(function (error) {
                    console.log(error);
                    _this.$store.state.httpRequest = false;
                    Vue.swal({title: 'Error', text: 'Whoops..!! something went wrong', icon: 'error'});
                });
            }
        });
    },
    getDataList: function(page = 1) {
        const _this = this;
        var listParameters = {
            per_page: 20,
            page: page,
        };
        let URL =this.$store.state.baseUrl + 'auth/' + this.dataUrl();
        // let URL =this.$store.state.baseUrl + 'auth/' + 'me';
        this.DataList = [];
        _this.$store.state.httpRequest = true;
        axios.get(URL).then(response => {
            if (parseInt(response.data.code) === 7000) {
                this.$swal({title: 'Warning', text: response.data.message, icon: 'warning',})
                this.$router.push('/dashboard');
            }

            _this.$store.state.httpRequest = false;
            this.DataList = response.data.data;
            this.$store.state.DataList = response.data.data;
            // console.log(this.$store.state.DataList);
        }).catch(function (error) {
            // console.log(error);
            _this.$store.state.httpRequest = false;
            Vue.swal({title: 'Error', text: 'Whoops..!! something went wrong', icon: 'error'});
        });
    },

    dataUrl: function () {
        return this.$route.meta.dataUrl;
    },
        showData(dataArray, fieldName) {
          // console.log(dataArray);
            if (dataArray[fieldName] !== undefined) {
                return dataArray[fieldName];
            } else {
                return '-';
            }
        },

        editInformation : function(data, edit_data_id, modalId,title = ''){
            this.formDataArray = data;
            this.$store.state.currentUpdateId = edit_data_id;
            this.$store.state.activeFormType = 2;
            this.$store.state.activeModal = modalId;
            this.openModal(modalId,title);
        },
        deleteData: function (index, dataId, payload = {}) {
            let URL = this.$store.state.baseUrl + 'auth/' + this.dataUrl() + '/' + dataId;
            const _this = this;
            this.$swal({
                title: 'Are you sure..??',
                text: 'Data will be delete Permanently??',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes',
                cancelButtonText: 'No',
                showCloseButton: true,
            }).then((result) => {
                if (result.value) {
                    this.$store.state.httpRequest = true;
                    axios.delete(URL, {data: payload}).then(response => {
                        if (parseInt(response.data.code) === 7000) {
                            this.$swal({title: 'Warning', text: response.data.message, icon: 'warning',})
                        }

                        if (parseInt(response.data.code) === 2000) {
                            _this.getDataList();
                            this.$store.state.httpRequest = false;
                            this.$swal({title: 'Success', text: response.data.message, icon: 'success'});
                        } else {
                            this.$store.state.httpRequest = false;
                            this.$swal({title: 'Warning', text: response.data.message, icon: 'warning'});
                        }
                    }).catch(function (error) {
                        console.log(error);
                        _this.$store.state.httpRequest = false;
                        Vue.swal({title: 'Error', text: 'Whoops..!! something went wrong', icon: 'error'});
                    });
                }
            });
        },


        isLoadComplete: function (type = true) {
            if (type) {
                this.$store.state.httpRequest = false;
                this.$store.state.isLoaded = true;
                this.isLoaded = true;
            } else {
                this.$store.state.httpRequest = true;
                this.$store.state.isLoaded = false;
                this.isLoaded = false;
            }
        },




},
computed:{

}
}