import React from "react";
import {
  TextInputField,
  Text,
  Pane,
  Heading,
  Button,
  Link
} from "evergreen-ui";

function Login() {
  return (
    <Pane
      background="tint2"
      display="flex"
      justifyContent="center"
      flexDirection="column"
      padding={20}
      width={360}
      borderRadius={5}
      elevation={3}
    >
      <Heading size={700} textAlign="center" paddingBottom="2rem">
        Log in
      </Heading>
      <TextInputField required label="Username" />
      <TextInputField required type="password" label="Password" />
      <Button appearance="primary" justifyContent="center">
        Log in
      </Button>
      <Text textAlign="center" marginTop="2rem">
        Forgot your password? <Link href="#"> Reset your password</Link>
      </Text>
      <Text textAlign="center">
        Don't have an account? <Link href="#">Sign up</Link>
      </Text>
    </Pane>
  );
}

export default Login;
