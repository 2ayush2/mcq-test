import { Typography, Box, Skeleton, Badge } from '@mui/material';
import Txt from 'components/Text';
import DeleteIcon from '@mui/icons-material/Delete';
import { QuestionTypesList, QuestionTypes } from 'links';
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

function Type({ type, code, ...rest }) {
  console.log(type, code,QuestionTypesList);
  return (
    <Badge
      variant="gradient"
      badgeContent={<div>{type}</div>}
      color={QuestionTypesList[code].color}
      {...rest}
    />
  );
}

const modelList = (list, handleView) => {
  return list.map(({ id, question, answer, type, typeCode }) => {
    return {
      question: <Text text={question} />,
      answer: <Text text={answer} />,
      type: (
        <Type
          type={type}
          code={typeCode}
          sx={{ width: '81px', marginRight: '81px' }}
        />
      ),
      action: (
        <a
          style={{ cursor: 'pointer' }}
          onClick={() => {
            handleView(id);
          }}
        >
          <DeleteIcon color="danger" />
        </a>
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
      question: [
        { colSpan: '4' },
        <Skeleton animation="wave" variant="text" width="80%" height={30} />
      ]
    },
    {
      question: [
        { colSpan: '4' },
        <Skeleton animation="wave" variant="text" width="70%" height={30} />
      ]
    },
    {
      question: [
        { colSpan: '4' },
        <Skeleton animation="wave" variant="text" width="90%" height={30} />
      ]
    }
  ];
};

const columns = [
  { label: 'SNO', type: 'serial_no', align: 'center' },
  { name: 'question', align: 'left' },
  { name: 'answer', label: 'Answer', align: 'left' },
  { name: 'type', align: 'center' },
  { name: 'action', align: 'center' }
];

export { columns, modelList, modelListInit, modelListEmpty };
