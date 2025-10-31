import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import { Head } from '@inertiajs/react';
import { useForm } from '@inertiajs/react';
import InputError from '@/Components/InputError';
import InputLabel from '@/Components/InputLabel';
import TextInput from '@/Components/TextInput';
import { FormEventHandler } from 'react';
import PrimaryButton from '@/Components/PrimaryButton';
import { User } from '@/types';
import Radio from '@/Components/Radio';

export default function Edit({user, roles, roleLabels} : {user: User, roles: any[], roleLabels: Record<string, string>}) {
    
    const{
        data,
        setData,
        put,
        errors,
        reset,
        processing,
    } = useForm({
        name: user.name,
        email: user.email,
        roles: user.roles,
    });

    console.log(roles);
    console.log(data);

    const updateUser: FormEventHandler = (e) => {
        e.preventDefault();
        put(route('user.update', user.id), {
            preserveScroll: true,
        });
    }

    return (
        <AuthenticatedLayout
            header={
                <h2 className="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
                    Edit User <b>{user.name}</b>
                </h2>
            }
        >
            <Head title={`Edit User ${user.name}`} />
            
            <div className="py-12">
                <div className="mx-auto max-w-7xl sm:px-6 lg:px-8">
                    <div className="mb-4 overflow-hidden bg-white shadow-sm sm:rounded-lg dark:bg-gray-800">
                        <div className="p-6 text-gray-900 dark:text-gray-100 flex gap-8">
                            <form onSubmit={updateUser} className="w-full">
                                <div className="mb-7">
                                    <InputLabel htmlFor="name" value="Name" />
                
                                    <TextInput
                                        id="name"
                                        disabled
                                        className="mt-1 block w-full"
                                        value={data.name}
                                        onChange={(e) => setData('name', e.target.value)}
                                        isFocused
                                        autoComplete="name"
                                    />
                
                                    <InputError className="mt-2" message={errors.name} />
                                </div>
                                <div className="mb-7">
                                    <InputLabel htmlFor="email" value="Email" />
                
                                    <TextInput
                                        id="email"
                                        disabled
                                        className="mt-1 block w-full"
                                        value={data.email}
                                        onChange={(e) => setData('email', e.target.value)}
                                        isFocused
                                        autoComplete="email"
                                    />
                
                                    <InputError className="mt-2" message={errors.email} />
                                </div>
                                <div className="mb-7">
                                    <InputLabel htmlFor="roles" value="Role" />
                                    {roles.map((role) => (
                                        <label key={role.id} className="flex items-center gap-2">
                                            <Radio
                                                name="roles"
                                                value={role.name}
                                                checked={data.roles.includes(role.name)}
                                                onChange={(e) => {
                                                    setData(
                                                        'roles',
                                                        e.target.checked
                                                            ? [role.name]
                                                            : data.roles.filter((r) => r !== role.name),
                                                    );
                                                }}
                                            />
                                            {roleLabels[role.name]}
                                        </label>
                                    ))}
                                </div>

                                <div className="flex items-center gap-4">
                                    <PrimaryButton disabled={processing}>Save</PrimaryButton>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </AuthenticatedLayout>
    );
}
