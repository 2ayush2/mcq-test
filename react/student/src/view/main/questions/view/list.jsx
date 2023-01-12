// @mui material components
import { useEffect } from 'react';
import { useHistory } from 'react-router-dom';
// Soft UI Dashboard React components
import { Box, Button, Card, Typography } from '@mui/material';
// Soft UI Dashboard React example components
import { Table } from 'components/Table';
import { questionsPages } from 'links';

import {
  columns,
  modelList,
  modelListInit,
  modelListEmpty
} from '../model/list';
import { getQuestionList } from '../service';
import { useState } from 'react';

function QuestionsList() {
  const [questionList, setQuestion] = useState({
    questions: null,
    pg: {
      size: 0,
      pages: 0,
      current: 0,
      total: 0
    }
  });
  const history = useHistory();
  const handleView = (id, name) => {};
  const handleCreate = (e, current) => {
    history.push(questionsPages.QUESTION_NEW);
  };

  async function loadData(page) {
    await getQuestionList({ page }).then((res) => {
      if (res.flag) {
        const qdata = res.data.data;
        if (Object.keys(qdata).length) {
          setQuestion({
            questions: qdata
          });
        }
      }
    });
  }
  useEffect(() => {
    loadData(1);
    // return () => {
    //     dispatch(setItemList({ items: [], pg: {} }));
    // }
  }, []);

  const TableRender = () => {
    if (questionList.questions === null) {
      return (
        <div>
          <Table columns={columns} rows={modelListInit()} />
        </div>
      );
    } else if (questionList.questions == 0) {
      return (
        <div>
          <Table columns={columns} rows={modelListEmpty()} />
        </div>
      );
    } else {
      return (
        <div>
          <Table
            columns={columns}
            rows={modelList(questionList.questions, handleView)}
          />
        </div>
      );
    }
  };

  return (
    <Card>
      <Box
        display="flex"
        justifyContent="space-between"
        alignItems="center"
        p={3}
      >
        <Typography variant="h3">{'Questions'}</Typography>
        <Button variant="contained" onClick={handleCreate}>
          Create
        </Button>
      </Box>
      <Box>
        <TableRender />
      </Box>
    </Card>
  );
}

export default QuestionsList;
