import React from "react";

type Props = {
  name?: string;
}
export default function Hello(props: Props) {
  if (props.name) {
    return <h1>Hello, {props.name}!</h1>;
  } else {
    return <span>Hey, stranger</span>;
  }
}
