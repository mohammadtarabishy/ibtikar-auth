<template>
    <GuestLayout>
        <Head title="Log in" />
        <div class="grid grid-cols-3 h-screen w-screen">
            <div class="col-span-2 flex items-center justify-center bg-gray-100">
                <img class="w-full h-full object-cover" src="/assets/img/login2.jpg" alt="Sample Image" />
            </div>
            <div class="flex items-center justify-center bg-gradient-to-r from-slate-200 to-gray-200">
                <div class="row p-5 w-[80%]">
                    <dev class="mb-4" style="margin-bottom: 10px">
                        <Label value="Welcome To Ibtikar" class-data="font-extrabold text-3xl">

                        </Label>
                    </dev>
                    <form @submit.prevent="submit" class="w-full max-w-md bg-white p-3 rounded-lg bg-gradient-to-r from-slate-200 to-gray-200">
                        <div v-if="status" class="mb-4 text-green-600 font-medium text-sm">
                            {{ status }}
                        </div>
                        <div>
                            <InputLabel for="email" value="Email" />
                            <TextInput
                                id="email"
                                type="text"
                                class="mt-1 block w-full"
                                v-model="form.email"
                                required
                                autofocus
                                autocomplete="username"
                            />
                            <InputError class="mt-2" :message="form.errors.email" />
                        </div>
                        <div class="mt-4">
                            <InputLabel for="password" value="Password" />
                            <TextInput
                                id="password"
                                type="password"
                                class="mt-1 block w-full"
                                v-model="form.password"
                                required
                                autocomplete="current-password"
                            />
                            <InputError class="mt-2" :message="form.errors.password" />
                        </div>
                        <div class="block mt-4">
                            <label class="flex items-center">
                                <Checkbox name="freeIPA" v-model:checked="form.use_ldap" />
                                <span class="ml-2 text-sm text-gray-600">Use FreeIPA</span>
                            </label>
                        </div>
                        <div class="flex items-center justify-end mt-4">
                            <PrimaryButton class="ml-6" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                                Log in
                            </PrimaryButton>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </GuestLayout>
</template>
<script setup lang="ts">
import Checkbox from '@/Components/Checkbox.vue';
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, useForm } from '@inertiajs/vue3';
import Label from "@/Components/Label.vue";
defineProps<{
    canResetPassword?: boolean;
    status?: string;
}>();

const form = useForm({
    email: '',
    password: '',
    use_ldap: false,
});
const submit = () => {
    form.post(route('login'), {
        onFinish: () => {
            form.reset('password');
        },
    });
};
</script>
