<script setup>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
import BreezeButton from '@/Components/Button.vue';
import BreezeInput from '@/Components/Input.vue';
import BreezeLabel from '@/Components/Label.vue';
import { Head } from '@inertiajs/inertia-vue3';
import { Link }  from '@inertiajs/inertia-vue3';
import Modal from '@/Components/Modal.vue';
import {useForm } from '@inertiajs/inertia-vue3';


const form = useForm({
    titulo: '',    
});

const submit = () => {
    form.post(route('dashboard.store'),
     {
        onFinish: () => $emit('close'),
    });
};

</script>


<script>
export default {
        components: {
            Modal
        },
        props: {
            quadros: Object,
            quadro_membros:Object
        },
        data() {
            return {
                showModal: false
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
                        <div v-for="quadro in quadros">
                         <Link :href="route('board',quadro.id)" class="underline text-sm text-gray-600 hover:text-gray-900">
                                {{quadro.titulo}}
                        </Link> 
                           
                        </div>
                        <div v-for="quadro_membro in quadro_membros">
                         <Link :href="route('board',quadro_membro.id)" class="underline text-sm text-gray-600 hover:text-gray-900">
                                {{quadro_membro.titulo}}
                        </Link> 
                           
                        </div>
                    </div>
                    <button id="show-modal" @click="showModal = true">Adicionar Quadro</button>                    
  
                    <Teleport to="body">
                        <!-- use the modal component, pass in the prop -->
                        <modal :show="showModal" @close="showModal = false">
                        <template #header>
                            <h3>Adicionar Projecto</h3>
                        </template>
                        <template #body>
                                
                                 <form @submit.prevent="submit">
                                    <div>
                                        <BreezeLabel for="titulo" value="Título" />
                                        <BreezeInput id="titulo" type="text" class="mt-1 block w-full" v-model="form.titulo" required autofocus autocomplete="titulo" />
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
