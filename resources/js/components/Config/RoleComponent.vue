<template>
    <section>
        <div class="container">
            <Breadcrumb></Breadcrumb>

            <div class="table-body">
                <div class="table-header">
                    <div class="row">
                        <div class="col-sm-3">
                            <i class="fa fa-list"></i> Role List
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
                            <a v-if="$store.state.isLoaded && $store.state.permission.role[0]['create'] == 1" class="btn btn-sm btn-default float-right border on-border" @click="openModal('createModal','Add New  Role')" ><i class="fa fa-plus"></i> Add New  Role</a>
                        </div>
                    </div>
                </div>
                <div class="table-body">
                    <table class="table table-sm">
                        <thead>
                        <tr>
                            <td>#</td>
                            <td>Role Name</td>
                            <td>Action</td>
                        </tr>
                        </thead>
                        <tbody>
                        <tr v-if="$store.state.DataList.data" v-for="(data, index) in $store.state.DataList.data">
                            <td>{{parseInt($store.state.DataList.from)+ parseInt(index)}}</td>
                            <td>{{data.role_name}}</td>
                            <td>
                                <a v-if="$store.state.permission.role[0]['delete'] == 1" class="pointer" @click="deleteData(index, data.id);"><i class="fa fa-trash"></i> </a>
                                <a v-if="$store.state.permission.role[0]['edit'] == 1" class="pointer"  @click="editInformation(data, data.id, 'createModal','Edit Role')"><i class="fa fa-edit"></i> </a>
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
                                    <td style="width: 20%;" class="label-tr">Role Name</td>
                                    <td style="width: 20%;" class="float-right">:</td>
                                    <td style="width: 60%" >
                                        <input type="text"  v-validate="'required'" name="role_name" v-model="formDataArray.role_name" class="form-control form-control-sm" placeholder="Role Name">
                                        <span class="error_text">{{ errors.first('role_name') }}</span>
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
        name: "RoleComponent",
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