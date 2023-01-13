import React from "react";
import ReactDOM from "react-dom";
import { BrowserRouter } from "react-router-dom";
import App from "./App";
import { SnackbarProvider } from "notistack";

ReactDOM.render(
    <React.StrictMode>
        <BrowserRouter>
            <SnackbarProvider maxSnack={5}>
                <App />
            </SnackbarProvider>
        </BrowserRouter>
    </React.StrictMode>,
    document.getElementById("root")
);
