<?php
class Task extends Model
{
    public function getAll()
    {
        $stmt = $this->db->query("SELECT * FROM tasks");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById($id)
    {
        $stmt = $this->db->prepare("SELECT * FROM tasks WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function create($task_name)
    {
        $stmt = $this->db->prepare("INSERT INTO tasks (task_name) VALUES (?)");
        return $stmt->execute([$task_name]);
    }

    public function update($id, $task_name)
    {
        $stmt = $this->db->prepare("UPDATE tasks SET task_name = ? WHERE id = ?");
        return $stmt->execute([$task_name, $id]);
    }

    public function delete($id)
    {
        $stmt = $this->db->prepare("DELETE FROM tasks WHERE id = ?");
        return $stmt->execute([$id]);
    }
}
