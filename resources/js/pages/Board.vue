<script>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
import BreezeButton from '@/Components/Button.vue';
import BreezeInput from '@/Components/Input.vue';
import BreezeLabel from '@/Components/Label.vue';
import { Head } from '@inertiajs/inertia-vue3';
import { Link }  from '@inertiajs/inertia-vue3';
import Modal from '@/Components/Modal.vue';
import {useForm } from '@inertiajs/inertia-vue3';

export default {
    components: {
            BreezeAuthenticatedLayout, BreezeButton, BreezeInput, Head, Link, Modal, useForm
    },
    props: {
            quadro: Object,
            listas: Object,
            quadro_id: '',
            membros: Object,
            user_id: Object
    },
    setup(props) {
        const form = useForm({
            quadro_id: props.quadro_id,
            titulo: '',
            id_membro:''
        })



        return { form }
    },
    data() {
        return {
            showModal: false,
            membrosmodal:false
            
        }
    }
    
}

</script>

<template>
    <Head title="Dashboard" />

    <BreezeAuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Dashboard
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <div v-for="lista in listas">
                        
                                {{lista.titulo}}
                        
                           
                        </div>
                    </div>
                    <button id="show-modal" @click="showModal = true">Adicionar Lista</button>&nbsp;&nbsp;&nbsp;&nbsp;
                    <div v-if="quadro.user_id == user_id">
                        <button id="membros-modal" @click="membrosmodal = true">Adicionar Membros</button>                    
                    </div>
                    
  
                    <Teleport to="body">
                        <!-- use the modal component, pass in the prop -->
                        <modal :show="showModal" @close="showModal = false">
                        <template #header>
                            <h3>Adicionar Lista</h3>
                        </template>
                        <template #body>
                                
                                 <form @submit.prevent="form.post(route('board.store'))">
                                    <div>
                                        <BreezeLabel for="titulo" value="Título" />
                                        <BreezeInput id="titulo" type="text" class="mt-1 block w-full" v-model="form.titulo" required autofocus autocomplete="titulo" />
                                    </div>

                                    
                                     <div>
                                        
                                        <BreezeInput id="quadro_id" type="hidden" class="mt-1 block w-full" v-model="form.quadro_id" required autofocus autocomplete="titulo" />
                                    </div>
                                    
                                    <div class="flex items-center justify-end mt-4">
                                      

                                        <BreezeButton class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                                            Salvar
                                        </BreezeButton>
                                    </div>
                                </form>
                        </template>
                        </modal>


                        <!-- use the modal component, pass in the prop -->
                        <modal :show="membrosmodal" @close="membrosmodal = false">
                        <template #header>
                            <h3>Membros</h3>
                        </template>
                        <template #body>
                                
                                 <form @submit.prevent="form.post(route('board_membro.store'))">
                                    <div>
                                        <BreezeLabel for="titulo" />
                                        <select id="titulo" v-model="form.id_membro">
                                            <option>seleccionar membros</option>
                                            <option v-for="membro in membros" :key="membro.id" :value="membro.id" >{{membro.nome}}</option>
                                        </select>
                                        
                                    </div>

                                    
                                     <div>
                                        
                                        <BreezeInput id="quadro_id" type="hidden" class="mt-1 block w-full" v-model="form.quadro_id" required autofocus autocomplete="titulo" />
                                    </div>
                                    
                                    <div class="flex items-center justify-end mt-4">
                                      

                                        <BreezeButton class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                                            Salvar
                                        </BreezeButton>
                                    </div>
                                </form>
                        </template>
                        </modal>
                        
                        </Teleport>

                </div>
            </div>
             


        </div>
    </BreezeAuthenticatedLayout>
</template>
