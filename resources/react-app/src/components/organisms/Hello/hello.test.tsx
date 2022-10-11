import React from "react";
import { createRoot, Root } from 'react-dom/client';
import { act } from 'react-dom/test-utils';

import Hello from './hello';

let container: HTMLDivElement;
let root: Root;

beforeEach(() => {
  container = document.createElement('div');
  document.body.appendChild(container);
  root = createRoot(container!);
});

afterEach(() => {
  // cleanup on exiting
  root.unmount();
});

it('render with or without a name', () => {
  act(() => {
    root.render(<Hello />);
  });
  expect(container.textContent).toBe("Hey, stranger");
  
  act(() => {
    root.render(<Hello name="tot" />);
  });
  expect(container.textContent).toBe("Hello, tot!");
});
