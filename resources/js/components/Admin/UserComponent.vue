<template>
    <section>
        <div class="container">
            <Breadcrumb></Breadcrumb>

            <div class="table-body">
                <div class="table-header">
                    <div class="row">
                        <div class="col-sm-3">
                            <i class="fa fa-list"></i> User List
                        </div>
                        <div class="col-sm-7">
                            <table style="float: right;">
                                <tr>
                                    <td>
                                        <input type="text" name="" class="border on-border" placeholder="Search By Name" />
                                    </td>
                                    <td>
                                        <a type="submit" class="btn btn-sm btn-default float-right border on-border" href=""><i class="fa fa-search"></i> Search</a>
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-sm-2">
                            <a class="btn btn-sm btn-default float-right border on-border" @click="openModal('createModal','Add New  User')" ><i class="fa fa-plus"></i> Add New  User</a>
                        </div>
                    </div>
                </div>
                <div class="table-body">
                    <table class="table table-sm">
                        <thead>
                        <tr>
                            <td>#</td>
                            <td>Name</td>
                            <td>Email</td>
                            <td>Phone</td>
                            <td>Gender</td>
                            <td>Role</td>
                            <td>Status</td>
                            <td>Action</td>
                        </tr>
                        </thead>
                        <tbody>
                        <tr v-if="$store.state.DataList.data" v-for="(data, index) in $store.state.DataList.data">
                            <td>{{parseInt($store.state.DataList.from)+ parseInt(index)}}</td>
                            <td>{{data.first_name}} {{data.last_name}}</td>
                            <td>{{data.email}} </td>
                            <td>{{data.phone}} </td>
                            <td>{{data.gender}} </td>
                            <td>{{data.role.role_name}} </td>
                            <td v-if="data.status == 1">Active</td>
                            <td v-else>Inactive</td>
                            <td>
                                <a class="pointer" @click="deleteData(index, data.id);"><i class="fa fa-trash"></i> </a>
                                <a class="pointer"  @click="editInformation(data, data.id, 'createModal','Edit User ')"><i class="fa fa-edit"></i> </a>
                            </td>
                        </tr>

                        </tbody>
                    </table>
                </div>

                <div class="table-footer">
                    <nav aria-label="Page navigation example ">
                        <ul class="pagination justify-content-end">

                            <div v-if="parseInt($store.state.DataList.total)>0">
                                <advanced-laravel-vue-paginate previousText="PREV" nextText="NEXT" :data="$store.state.DataList" @paginateTo="getDataList"/>
                            </div>

                        </ul>
                    </nav>
                </div>

            </div>


        </div>

        <div id="createModal" class="modal fade bd-example-modal-lg" >
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <ModalHeader ></ModalHeader>
                    <form @submit.prevent="submitForm(formDataArray)">
                        <div class="modal-body">
                            <table style="width: 100%;">
                                <tr>
                                    <td style="width: 20%;" class="label-tr">Menu Name</td>
                                    <td style="width: 20%;" class="float-right">:</td>
                                    <td style="width: 60%" >
                                        <input type="text"  v-validate="'required'" name="menu_name" v-model="formDataArray.menu_name" class="form-control form-control-sm" placeholder="Menu Name">
                                        <span class="error_text">{{ errors.first('menu_name') }}</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width: 20%;" class="label-tr">Menu Url</td>
                                    <td style="width: 20%;" class="float-right">:</td>
                                    <td style="width: 60%" >
                                        <input type="text" name="url" class="form-control form-control-sm" v-model="formDataArray.url" placeholder="Menu URL">
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width: 20%;" class="label-tr">Menu Icon</td>
                                    <td style="width: 20%;" class="float-right">:</td>
                                    <td style="width: 60%" >
                                        <input type="text" name="icon" class="form-control form-control-sm" v-model="formDataArray.icon" placeholder="fa fa-user">
                                    </td>
                                </tr>

                                <tr>
                                    <td style="width: 20%;" class="label-tr">Menu Type</td>
                                    <td style="width: 20%;" class="float-right">:</td>
                                    <td style="width: 60%" >
                                        <select type="text" name="menu_type" class="form-control form-control-sm" v-model="formDataArray.menu_type">
                                            <option value="" selected="selected">--Select--</option>
                                            <option value="1">Single Menu</option>
                                            <option value="2">Dropdown Menu</option>
                                            <option value="3">Page Menu</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width: 20%;" class="label-tr">Parent</td>
                                    <td style="width: 20%;" class="float-right">:</td>
                                    <td style="width: 60%" >
                                        <select type="text" name="parent" class="form-control form-control-sm" v-model="formDataArray.parent">
                                            <option value="0" selected="selected">--Select--</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width: 20%;" class="label-tr"> Type</td>
                                    <td style="width: 20%;" class="float-right">:</td>
                                    <td style="width: 60%" >
                                        <select type="text" name="type" class="form-control form-control-sm" v-model="formDataArray.type">
                                            <option value="" selected="selected">--Select--</option>
                                            <option value="1">Frontend</option>
                                            <option value="2">Backend</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width: 20%;" class="label-tr">Status</td>
                                    <td style="width: 20%;" class="float-right">:</td>
                                    <td style="width: 60%" >
                                        <select type="text" name="status " class="form-control form-control-sm" v-model="formDataArray.status">
                                            <option value="" selected="selected">--Select--</option>
                                            <option value="1">Active</option>
                                            <option value="0">Inactive</option>
                                        </select>
                                    </td>
                                </tr>


                            </table>
                        </div>
                        <ModalFooter></ModalFooter>
                    </form>
                </div>
            </div>
        </div>




    </section>

</template>

<script>
    import Breadcrumb from '../Breadcrumb.vue';
    import ModalFooter from "../ModalFooter";
    import ModalHeader from "../ModalHeader";
    export default {
        name: "UserComponent",
        components: {Breadcrumb, ModalFooter, ModalHeader},
        data() {
            return {

            };
        },
        methods: {

        },

        mounted(){
            this.getDataList();
        }
    }
</script>

<style scoped>

</style>