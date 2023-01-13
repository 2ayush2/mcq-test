import { useEffect } from "react";
import { Route, useLocation, Switch } from "react-router-dom";
import ThemeProvider from "./theme/ThemeProvider";
import MainLayout from "components/layouts";
import { pages } from "links";
import Welcome from "view/Welcome";
import { Box, Card } from "@mui/material";
import Questions from "view/Questions";
import "./index.css";
export default function App() {
    const { pathname } = useLocation();
    useEffect(() => {
        document.documentElement.scrollTop = 0;
        document.scrollingElement.scrollTop = 0;
    }, [pathname]);

    return (
        <ThemeProvider>
            <MainLayout>
                <Box mx={10} my={2}>
                    <Card sx={{ minHeight: 400 }}>
                        <Box p={4}>
                            <Switch>
                                <Route
                                    path={pages.QUESTIONS}
                                    component={Questions}
                                />
                                <Route
                                    path={pages.WELCOME}
                                    component={Welcome}
                                />
                            </Switch>
                        </Box>
                    </Card>
                </Box>
            </MainLayout>
        </ThemeProvider>
    );
}
