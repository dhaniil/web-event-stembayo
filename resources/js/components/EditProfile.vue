<template>
    <div>
        <h1>Edit Profile</h1>
        <form @submit.prevent="updateProfile">
            <div>
                <label for="name">Name:</label>
                <input type="text" v-model="user.name" required>
            </div>
            <div>
                <label for="email">Email:</label>
                <input type="email" v-model="user.email" required>
            </div>
            <div>
                <label for="password">Password:</label>
                <input type="password" v-model="password">
            </div>
            <div>
                <label for="kelas">Kelas:</label>
                <input type="number" v-model="user.kelas">
            </div>
            <div>
                <label for="jurusan">Jurusan:</label>
                <input type="text" v-model="user.jurusan">
            </div>
            <div>
                <label for="profile_picture">Profile Picture:</label>
                <input type="file" @change="handleFileUpload">
            </div>
            <button type="submit">Update Profile</button>
        </form>
        <p v-if="successMessage">{{ successMessage }}</p>
    </div>
</template>

<script>
export default {
    props: {
        user: Object,
    },
    data() {
        return {
            password: '',
            successMessage: '',
            file: null,
        };
    },
    methods: {
        handleFileUpload(event) {
            this.file = event.target.files[0];
        },
        async updateProfile() {
            const formData = new FormData();
            formData.append('name', this.user.name);
            formData.append('email', this.user.email);
            if (this.password) {
                formData.append('password', this.password);
            }
            formData.append('kelas', this.user.kelas);
            formData.append('jurusan', this.user.jurusan);
            if (this.file) {
                formData.append('profile_picture', this.file);
            }

            const response = await fetch('/profile/update', {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                },
            });

            if (response.ok) {
                this.successMessage = 'Profile updated successfully!';
                window.location.reload(); // Refresh to see the updated profile
            } else {
                console.error('Failed to update profile.');
            }
        },
    },
};
</script>
