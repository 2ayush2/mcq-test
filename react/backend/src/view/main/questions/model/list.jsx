import { Typography, Box, Skeleton, Badge } from '@mui/material';
import Txt from 'components/Text';
import MailOutlineIcon from '@mui/icons-material/MailOutline';
import MarkEmailReadIcon from '@mui/icons-material/MarkEmailRead';
import { MailStatusList } from 'links';
import { MailStatus } from 'links';
function Text({ text, edge, warpLength, ...rest }) {
  return (
    <Box
      display="flex"
      pl={edge ? 2.5 : 0.5}
      pr={edge ? 2.5 : 0.5}
      pt={1.5}
      pb={1.25}
    >
      <Txt warpLength={warpLength}>{text}</Txt>
    </Box>
  );
}

function Status({ status, code, ...rest }) {
  return (
    <Badge
      variant="gradient"
      badgeContent={<div>{status}</div>}
      color={MailStatusList[code].color}
      {...rest}
    />
  );
}

const modelList = (list, handleView) => {
  return list.map(({ id, title, expire, mail, mailCode }) => {
    return {
      title: <Text text={title} />,
      expiry_date: <Text text={expire} />,
      status: (
        <Status
          status={mail}
          code={mailCode}
          sx={{ width: '81px', marginRight: '81px' }}
        />
      ),
      action:
        mailCode == MailStatus.PENDING ? (
          <a
            style={{ cursor: 'pointer' }}
            onClick={() => {
              handleView(id);
            }}
          >
            <MailOutlineIcon />
          </a>
        ) : (
          <MarkEmailReadIcon />
        )
    };
  });
};

const modelListEmpty = () => {
  return [
    {
      title: [
        { colSpan: '3', style: { textAlign: 'center' } },
        <Typography component="span" fontWeight="medium" p={20}>
          No data found
        </Typography>
      ]
    }
  ];
};

const modelListInit = () => {
  return [
    {
      title: [
        { colSpan: '4' },
        <Skeleton animation="wave" variant="text" width="80%" height={30} />
      ]
    },
    {
      title: [
        { colSpan: '4' },
        <Skeleton animation="wave" variant="text" width="70%" height={30} />
      ]
    },
    {
      title: [
        { colSpan: '4' },
        <Skeleton animation="wave" variant="text" width="90%" height={30} />
      ]
    }
  ];
};

const columns = [
  { label: 'SNO', type: 'serial_no', align: 'center' },
  { name: 'title', align: 'left' },
  { name: 'expiry_date', label: 'Expiry Date', align: 'left' },
  { name: 'status', align: 'center' },
  { name: 'action', align: 'center' }
];

export { columns, modelList, modelListInit, modelListEmpty };
