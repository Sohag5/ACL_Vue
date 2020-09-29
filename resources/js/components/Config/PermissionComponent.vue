<template>
    <section>
        <div class="container">
            <Breadcrumb></Breadcrumb>
            <form @submit.prevent="submitForm(formDataArray)">
            <div class="table-body">
                <div class="table-header">
                    <div class="row">
                        <div class="col-sm-3">
                            <i class="fa fa-list"></i> Permission
                        </div>
                        <div class="col-sm-7">
                            <table style="float: right;">
                                <tr>
                                    <td>

                                    </td>
                                    <td>

                                    </td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-sm-2">
                            <select v-if="$store.state.isLoaded && $store.state.permission.permission[0]['create'] == 1" v-model="Filter.role" @change="getData()" class="float-right">
                                <option value="">--Select Role--</option>
                                <option v-for="(data,index) in $store.state.DataList.role" :value="data.id">{{data.role_name}}</option>
                            </select>
<!--                            <button type="submit" class="btn btn-success btn-sm"><i class="fa fa-file"></i> Submit</button>-->
                        </div>
                    </div>
                </div>
                <div class="table-body">
                    <table class="table table-sm">
                        <thead>
                        <tr>
                            <td>Menu </td>
                            <td>own </td>
                            <td>Create</td>
                            <td>Insert</td>
                            <td>View</td>
                            <td>Edit</td>
                            <td>Update</td>
                            <td>Delete</td>
                        </tr>
                        </thead>
                        <tbody >
                        <tr v-if="Filter.role != 0" v-for="(data,index) in $store.state.DataList.menu">
                          <td>{{data.menu_name}}</td>
                            <td><input :checked="showw.find(element => element == data.id)" type="checkbox" @click="checkEvent($event,formDataArray.show,data.id,'show')" name="show"></td>
                            <td><input :checked="create.find(element => element == data.id)" type="checkbox" @click="checkEvent($event,formDataArray.create,data.id,'create')" name="create"></td>
                            <td><input :checked="insert.find(element => element == data.id)" type="checkbox" @click="checkEvent($event,formDataArray.insert,data.id,'insert')"  name="insert"></td>
                            <td><input :checked="view.find(element => element == data.id)" type="checkbox" @click="checkEvent($event,formDataArray.view,data.id)"  name="view"></td>
                            <td><input :checked="edit.find(element => element == data.id)" type="checkbox" @click="checkEvent($event,formDataArray.edit,data.id,'edit')" name="edit"></td>
                            <td><input :checked="update.find(element => element == data.id)" type="checkbox" @click="checkEvent($event,formDataArray.update,data.id,'update')"  name="update"></td>
                            <td><input :checked="destroy.find(element => element == data.id)" type="checkbox" @click="checkEvent($event,formDataArray.delete,data.id,'delete')"  name="delete"></td>
                        </tr>

                        </tbody>
                    </table>
                </div>
                <div class="row">
                    <div class="col-sm-3">

                    </div>
                    <div class="col-sm-7">
                        <table style="float: right;">
                            <tr>
                                <td>

                                </td>
                                <td>

                                </td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-sm-2" style="margin-top:7px">
                        <button v-if="$store.state.permission.permission[0]['insert'] == 1" type="submit" class="btn btn-success btn-sm float-right"><i class="fa fa-file"></i> Submit</button>
                    </div>
                </div>



            </div>
            </form>

        </div>



    </section>

</template>

<script>
    import Breadcrumb from '../Breadcrumb.vue';
    export default {
        name: "PermissionComponent",
        components: {Breadcrumb},

        data(){
            return{
                formDataArray:{
                    show:[],
                    create:[],
                    insert:[],
                    view:[],
                    edit:[],
                    update:[],
                    delete:[],
                    role:'',
                },
                Filter:{
                    role:'',
                },
                showw:[],
                create:[],
                insert:[],
                view:[],
                edit:[],
                update:[],
                destroy:[],

            }
        },
        methods:{
            checkEvent(event,name,value,title){
                const _this = this;
                let arr = name;
                console.log(arr);
                if(arr !== undefined){
                    if(event.target.checked === true){
                        arr.push(value);
                    }else{
                        //
                        if(arr.length !=undefined && arr.length == 0){
                            arr.splice(arr.indexOf(value), 1);
                        }else{
                            let newArr = [];
                            $.each(arr,function (i,v) {
                                if( v != value){
                                    newArr.push(v);
                                }
                            })
                            if(title =='show'){
                                _this.formDataArray.show = newArr;
                            }
                            if(title =='create'){
                                _this.formDataArray.create = newArr;
                            }
                            if(title =='insert'){
                                _this.formDataArray.insert = newArr;
                            }
                            if(title =='view'){
                                _this.formDataArray.view = newArr;
                            }
                            if(title =='edit'){
                                _this.formDataArray.edit = newArr;
                            }
                            if(title =='update'){
                                _this.formDataArray.update = newArr;
                            }
                            if(title =='delete'){
                                _this.formDataArray.delete = newArr;
                            }
                        }
                    }
                }else{
                    this.Filter.role = '';
                    this.getData();
                }



            },
            getData() {
                const _this = this;
                _this.formDataArray.role = _this.Filter.role;
                _this.showw = [];
                _this.create = [];
                _this.insert = [];
                _this.view = [];
                _this.edit = [];
                _this.update = [];
                _this.destroy = [];
                _this.formDataArray.show= _this.showw;
                _this.formDataArray.create= _this.create;
                _this.formDataArray.insert= _this.insert;
                _this.formDataArray.view= _this.view;
                _this.formDataArray.edit= _this.edit;
                _this.formDataArray.update= _this.update;
                _this.formDataArray.delete= _this.destroy;

                let URL =this.$store.state.baseUrl + 'auth/' + this.dataUrl()+ '/' + _this.Filter.role;
                _this.$store.state.httpRequest = true;
                axios.get(URL).then(response => {
                    _this.$store.state.httpRequest = false;
                     $.each(response.data.data.permission,function (index,data) {

                         if(data.show == 1 && _this.Filter.role == data.role){
                             _this.showw.push(data.menu_id);
                         }

                         if(data.create == 1 && _this.Filter.role == data.role){
                             _this.create.push(data.menu_id);
                         }

                         if(data.edit == 1 && _this.Filter.role == data.role){
                             _this.edit.push(data.menu_id);
                         }

                         if(data.insert == 1 && _this.Filter.role == data.role){
                             _this.insert.push(data.menu_id);
                         }

                         if(data.update == 1 && _this.Filter.role == data.role){
                             _this.update.push(data.menu_id);
                         }

                         if(data.delete == 1 && _this.Filter.role == data.role){
                             _this.destroy.push(data.menu_id);
                         }

                         if(data.view == 1 && _this.Filter.role == data.role){
                             _this.view.push(data.menu_id);
                         }


                     });

                }).catch(function (error) {
                    console.log(error);
                    _this.$store.state.httpRequest = false;
                    Vue.swal({title: 'Error', text: 'Whoops..!! something went wrong hgfgjg', icon: 'error'});
                });
            },




        },
        mounted() {
            this.Filter.role = '';
            this.getDataList();
        }
    }
</script>

<style scoped>

</style>