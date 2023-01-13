import {
    Box,
    alpha,
    Stack,
    lighten,
    Divider,
    styled,
    useTheme,
} from "@mui/material";

import HeaderLogo from "components/Logo";
import { pages } from "links";
const HeaderWrapper = styled(Box)(
    ({ theme }) => `
        height: ${theme.header.height};
        color: ${theme.header.textColor};
        padding: ${theme.spacing(0, 2)};
        top: 0;
        right: 0;
        z-index: 7;
        background-color: ${alpha(theme.header.background, 0.95)};
        backdrop-filter: blur(3px);
        position: fixed;
        justify-content: space-between;
        width: 100%;
`
);

function Header() {
    const theme = useTheme();
    return (
        <HeaderWrapper
            display="flex"
            alignItems="center"
            sx={{
                boxShadow:
                    theme.palette.mode === "dark"
                        ? `0 1px 0 ${alpha(
                              lighten(theme.colors.primary.main, 0.7),
                              0.15
                          )}, 0px 2px 8px -3px rgba(0, 0, 0, 0.2), 0px 5px 22px -4px rgba(0, 0, 0, .1)`
                        : `0px 2px 8px -3px ${alpha(
                              theme.colors.alpha.black[100],
                              0.2
                          )}, 0px 5px 22px -4px ${alpha(
                              theme.colors.alpha.black[100],
                              0.1
                          )}`,
            }}
        >
            <Stack
                direction="row"
                divider={<Divider orientation="vertical" flexItem />}
                alignItems="center"
                spacing={2}
            >
                <HeaderLogo to={pages.HOME} sx={{ marginLeft: 3 }} />
            </Stack>
        </HeaderWrapper>
    );
}

export default Header;
