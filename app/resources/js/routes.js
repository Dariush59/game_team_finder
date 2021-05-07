import ExampleComponent from './components/RegistrationForm.vue';
import WelcomeComponent from './components/WelcomeComponent.vue';


export const routes = [
    {
        name: 'home',
        path: '/',
        component: ExampleComponent
    },
    {
        name: 'welcome',
        path: '/welcome',
        component: WelcomeComponent
    }
];