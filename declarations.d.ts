// We need to tell TypeScript that when we write "import styles from './styles.scss' we mean to load a module (to look for a './styles.scss.d.ts').
declare module "*.scss";
declare module "*.svg" {
  const content: any;
  export default content;
}

declare global {
  interface Window {
    _: any;
    axios: any;
  }
}
